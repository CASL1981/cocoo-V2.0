<?php

namespace Modules\Orders\Http\Livewire;

use App\Traits\CRUDLivewireTrait;
use App\Traits\TableLivewire;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\Classification;
use Modules\Basics\Entities\Client;
use Modules\Basics\Entities\Employee;
use Modules\Basics\Entities\Payment;
use Modules\Basics\Entities\Sequence;
use Modules\Basics\Entities\TypePrice;
use Modules\Orders\Entities\Operation;
use Modules\Orders\Http\Requests\RequestOperation;
use Modules\Orders\Services\OperationsServices;
use Modules\Orders\Services\OrderNumberService;

class Operations extends Component
{
    use WithPagination;
    use TableLivewire;
    use CRUDLivewireTrait;

    public $date, $status, $basic_client_id, $basic_payment_id, $basic_payment_interval, $observation, $basic_type_price_id;

    public $biller, $responsible, $basic_classification_id, $brute, $discount, $subtotal, $tax_sale, $total, $document, $number;

    public $providers, $typeprices, $payments, $categories, $employees, $documents;

    public $delivery_time = "INMEDIATA";

    protected $listeners = ['showaudit','deleteItem', 'toggleItem', 'processItem', 'reverseItem', 'detailOrder', 'pdfOrder'];

    public function hydrate()
    {
        $this->documents = Sequence::where('modelo', 'operation')->where('status', 'Open')->pluck('document', 'id')->toArray();

        $this->providers = Client::where('type', 'Proveedor')->where('status', true)->pluck('client_name', 'id')->toArray();

        $this->typeprices = TypePrice::where('status', 'Open')->pluck('name', 'id')->toArray();;

        $this->payments = Payment::pluck('name', 'id')->toArray();

        $this->categories = Classification::where('impute', true)->pluck('name', 'id')->toArray();

        $this->employees = Employee::where('status', true)->pluck('first_name', 'identification')->toArray();

        $this->permissionModel = 'operation';

        $this->messageModel = 'Orden';

        $this->model = 'Modules\Orders\Entities\Operation';
        $this->exportable ='App\Exports\OperationExport';
    }

    public function render()
    {
        $operations = new Operation();

        $operations = $operations->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)
                    ->paginate(20);

        return view('orders::livewire.operation.view', compact('operations'));

    }

    public function edit()
    {
        can('operation update');

        $status = Operation::withTrashed()->where('id', $this->selected_id)->get('status')->toArray();

        if($status[0]['status'] === 'Completed')
        {
            return $this->emit('alert', ['type' => 'warning', 'message' => 'Orden no se encuentra abierta']);
        }

        $record = Operation::findOrFail($this->selected_id);

        if(!$record->status){
            $this->resetInput();
            return $this->emit('alert', ['type' => 'warning', 'message' => 'Orden Inactiva']);
        }

        $this->document = $record->document;
        $this->number = $record->number;
        $this->date = $record->date;
        $this->basic_client_id = $record->basic_client_id;
        $this->basic_payment_id = $record->basic_payment_id;
        $this->basic_payment_interval = $record->basic_payment_interval;
        $this->observation = $record->observation;
        $this->delivery_time = $record->delivery_time;
        $this->basic_type_price_id = $record->basic_type_price_id;
        $this->biller = $record->biller;
        $this->responsible = $record->responsible;
        $this->basic_classification_id = $record->basic_classification_id;
        $this->brute = $record->brute;
        $this->discount = $record->discount;
        $this->subtotal = $record->subtotal;
        $this->tax_sale = $record->tax_sale;
        $this->total = $record->total;

        $this->show = true;
    }

    public function searchprovider()
    {
        $record = Client::find($this->basic_client_id);

        $this->basic_payment_id = $record->conditionpayment_id;
        $this->basic_type_price_id = $record->typeprice_id;
    }

    public function detailOrder()
    {
        can('operation delete');

        $status = Operation::withTrashed()->where('id', $this->selected_id)->get('status')->toArray();

        if($status[0]['status'] === 'Open')
        {
            return redirect()->route('order.detail.operation')->with('OrderId', $this->selected_id);
        }

        return $this->emit('alert', ['type' => 'warning', 'message' => 'Orden no se encuentra abierta']);
    }


    public function store()
    {
        can('operation create');

        $validate = $this->validate(app(RequestOperation::class)->rules());

        $validate = app(OperationsServices::class)->addFillableValidation($validate, $this);

        $validate = array_merge($validate, [
            'number' => app(OrderNumberService::class)->nextOrderNumber(),
        ]);

        $this->model::create($validate);

        app(OrderNumberService::class)->setNextOrderNumber();

        $this->resetInput();
    	$this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' creada']);

    }

    public function update()
    {
        can('operation update');
        //consultamos el estado de la orden
        $status = Operation::withTrashed()->where('id', $this->selected_id)->get('status')->toArray();

        //validamos eque la orden no este completada
        if($status[0]['status'] === 'Completed')
        {
            return $this->emit('alert', ['type' => 'warning', 'message' => 'Orden no se encuentra abierta']);
        }

        $requestOperation = new RequestOperation();
        $operationServices = new OperationsServices();

        $validate = $this->validate($requestOperation->rules());

        $validate = $operationServices->addFillableValidation($validate, $this);

        if ($this->selected_id) {
    		$record = $this->model::find($this->selected_id);
            $record->update($validate);

            $this->closed();
    		$this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' actualizada']);
        }
    }
    /**
     * actualizamos el campo de recibido
     */
    public function receive()
    {
        can('operation update');

        $status = Operation::withTrashed()->where('id', $this->selected_id)->get('status')->toArray();

        //validamos el estado de la orden se encuentre completed
        if($status[0]['status'] !== 'Completed')
        {
            return $this->emit('alert', ['type' => 'warning', 'message' => 'Orden no se encuentra Completed']);
        }

        // consultamos el modelo a actualizar
        if ($this->selected_id) {
    		$record = $this->model::find($this->selected_id);
            $record->update([ 'recibido' => !$record->recibido]); //actualizamos el recibido de la orden

            $this->closed();
    		$this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' actulizada']);
        }
    }

    public function processItem()
    {
        can('operation create');

        $operationServices = new OperationsServices();

        $validate = $operationServices->validateProcessOrder($this->selected_id, $this->selectedModel);

        if ($validate) {
            $this->resetInput();
            return $this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' Completada']);
        }

        return $this->emit('alert', ['type' => 'warning', 'message' => $this->messageModel . ' no esta abierta o en proceso, no se puede Procesar']);
    }

    public function reverseItem()
    {
        can($this->permissionModel . ' reverse');

        $operationServices = new OperationsServices();

        $validate = $operationServices->validateReverseOrder($this->selected_id);

        if ($validate) {
            $this->resetInput();
            return $this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' Activa']);
        }

        return $this->emit('alert', ['type' => 'warning', 'message' => $this->messageModel . ' no esta Anulado o Procesada']);
    }
}
