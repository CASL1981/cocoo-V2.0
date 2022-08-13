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
use Modules\Basics\Entities\TypePrice;
use Modules\Orders\Entities\DetailOperation;
use Modules\Orders\Entities\Operation;

class Operations extends Component
{
    use WithPagination;
    use TableLivewire;
    use CRUDLivewireTrait;

    public $date, $status, $basic_client_id, $basic_payment_id, $observation, $basic_type_price_id;
    

    public $biller, $responsible, $basic_classification_id, $brute, $discount, $subtotal, $tax_sale, $total;

    public $providers, $typeprices, $payments, $categories, $employees;
    
    protected $listeners = ['showaudit','deleteItem', 'toggleItem', 'processItem', 'reverseItem', 'detailOrder'];

    public function hydrate()
    {   
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

    protected function rules() 
    {        
        return [            
            'date' => 'required|date',
            'basic_client_id' => ['required'],
            'basic_payment_id' => ['required'],
            'observation' => 'nullable|max:255',
            'basic_type_price_id' => ['required'],
            'biller' => 'required|numeric',
            'responsible' => 'required|numeric',
            'basic_classification_id' => ['nullable'],
            'brute' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'subtotal' => 'nullable|numeric',
            'tax_sale' => 'nullable|numeric',
            'total' => 'nullable|numeric',
        ];
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

        $record = Operation::findOrFail($this->selected_id);

        if(!$record->status){
            $this->resetInput();
            return $this->emit('alert', ['type' => 'warning', 'message' => 'Orden Inactiva']);
        }
        
        $this->date = $record->date;
        $this->basic_client_id = $record->basic_client_id;
        $this->basic_payment_id = $record->basic_payment_id;
        $this->observation = $record->observation;
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

        $validate = $this->validate();

        $validate = $this->addFillableValidation($validate);
        
        $this->model::create($validate);
        
        $this->resetInput();        
    	$this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' creada']);
        
    }

    public function update()
    {
        can('operation update'); 

        $validate = $this->validate();

        $validate = $this->addFillableValidation($validate);

        if ($this->selected_id) {
    		$record = $this->model::find($this->selected_id);
            $record->update($validate);

            $this->closed();
    		$this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' actualizada']);
        }
    }

    public function addFillableValidation($validate)
    {
        $client_name = Client::whereId($this->basic_client_id)->first();
        $payment_name = Payment::whereId($this->basic_payment_id)->first();
        $typeprice_name = TypePrice::whereId($this->basic_type_price_id)->first();
        $classification_name = Classification::whereId($this->basic_classification_id)->first();
        
        return $validate = array_merge($validate, [
            'basic_client_name' => $client_name->client_name,
            'basic_payment_name' => $payment_name->name,
            'basic_type_price_name' => $typeprice_name->name,
            'basic_classification_name' => $classification_name->name,
        ]);
    }

    public function processItem()
    {
        can('operation create');

        $operation = Operation::find($this->selected_id);
        $status = Operation::withTrashed()->whereIn('id', $this->selectedModel)->get('status')->toArray();
        
        if($operation && $status[0]['status'] === 'Open') {
            $operation->update([ 'status' => 'Completed' ]); //actualizamos el estado de los modelos
            DetailOperation::where('order_operation_id',$this->selected_id)->update([ 'status' => 'Completed' ]); //actualizamos el estado de los registros del detalle de ordenes
            $this->resetInput();
            $this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' Cmpletada']);
        } else {
            $this->resetInput();
            $this->emit('alert', ['type' => 'warning', 'message' => $this->messageModel . ' no esta abierta o en proceso, no se puede Procesar']);
        }        
    }

    public function reverseItem()
    {
        can($this->permissionModel . ' reverse');
        
        $product = $this->model::withTrashed()->find($this->selected_id);
        
        if($product->deleted_by || $product->status == 'Completed') {
            $product->update([ 'deleted_by' => NULL, 'status' => 'Open' ]); //actualizamos el estado de los modelos
            $product->restore(); //reversamos la eliminación con softdelete
            DetailOperation::where('order_operation_id',$this->selected_id)->update([ 'status' => 'Open' ]); //actualizamos el estado de los registros del detalle de ordenes
            $this->resetInput();
            $this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' Activa']);            
        } else {
            $this->resetInput();
            $this->emit('alert', ['type' => 'warning', 'message' => $this->messageModel . ' no esta Anulado o Procesada']);
        }        
    }
}
