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
use Modules\Orders\Entities\Operation;
use Modules\Orders\Entities\TypePrice;

class Operations extends Component
{
    use WithPagination;
    use TableLivewire;
    use CRUDLivewireTrait;

    public $date, $status, $basic_client_id, $basic_payment_id, $observation, $order_type_price_id;
    

    public $biller, $responsible, $basic_classification_id, $brute, $discount, $subtotal, $tax_sale, $total;

    public $providers, $typeprices, $payments, $categories, $employees;
    
    protected $listeners = ['showaudit','deleteItem', 'toggleItem', 'processItem', 'reverseItem'];

    public function hydrate()
    {   
        $this->providers = Client::where('type', 'Proveedor')->where('status', true)->pluck('client_name', 'id')->toArray();

        $this->typeprices = TypePrice::where('status', true)->pluck('name', 'id')->toArray();

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
            'order_type_price_id' => ['required'],
            'biller' => 'nullable|numeric',
            'responsible' => 'nullable|numeric',
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
        // $this->bulkDisabled = count($this->selectedModel) < 1;        

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
        $this->order_type_price_id = $record->order_type_price_id;
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
        $this->order_type_price_id = $record->typeprice_id;
    }
}
