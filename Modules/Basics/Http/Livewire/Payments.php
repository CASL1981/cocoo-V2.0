<?php

namespace Modules\Basics\Http\Livewire;

use App\Traits\CRUDLivewireTrait;
use App\Traits\TableLivewire;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\Payment;

class Payments extends Component
{
    use WithPagination;
    use TableLivewire;
    use CRUDLivewireTrait;

    public $name, $quotas, $typeinterval, $interval;
        
    protected $listeners = 'showaudit';

    public function hydrate()
    {   
        $this->permissionModel = 'payment';
        
        $this->messageModel = 'Typo de pagó';

        $this->model = 'Modules\Basics\Entities\Payment';
        $this->exportable ='App\Exports\PaymentsExport';
    }

    protected function rules() 
    {
        return [        
            'name' => 'required|min:3|max:100',
            'quotas' => 'nullable|numeric', 
            'typeinterval' => 'nullable|max:1|in:D,M,Q,S',
            'interval' => 'nullable|numeric',            
        ];
    }
    
    public function render()
    {
        $payments = new Payment();

        $payments = $payments->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)->paginate(10);

        return view('basics::livewire.payment.view', compact('payments'));
    }

    public function edit()
    {   
        can('payment update'); 

        $record = Payment::findOrFail($this->selected_id);           
        
        $this->name = $record->name;
        $this->typeinterval = $record->typeinterval;
        $this->quotas = $record->quotas;        
        $this->interval = $record->interval;        

        $this->show = true;
    }
        
    // Modificamos la funacion del Trait TableLivewire
    public function auditoria()
    {        
        if ($this->selected_id) {
            $this->audit = $this->model::with(['creator', 'editor'])->find($this->selected_id)->toArray();                        
            $this->showauditor = true;
        } else {
            $this->emit('alert', ['type' => 'warning', 'message' => 'Selecciona un registros']);
        }
        
    }
}
