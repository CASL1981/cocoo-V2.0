<?php

namespace Modules\Basics\Http\Livewire;

use App\Traits\TableLivewire;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\Payment;

class Payments extends Component
{
    use WithPagination;
    use TableLivewire;

    public $name, $quotas, $typeinterval, $interval;
        
    protected $listeners = 'showaudit';

    public function mount()
    {                   
        $this->model = 'Modules\Basics\Entities\Payment';
        $this->exportable ='App\Exports\PaymentsExport';
    }

    protected function rules() 
    {
        return [        
            'name' => 'required|min:3|max:100',
            'quotas' => 'nullable|numeric', 
            'typeinterval' => 'nullable',
            'interval' => 'nullable|numeric',            
        ];
    }
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectedModel) < 1;

        $payments = new Payment();

        $payments = $payments->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)->paginate(10);        

        return view('basics::livewire.payment.view', compact('payments'));
    }

    
    public function store()
    {   
        can('payment create');

        $validate = $this->validate();    	
        
        Payment::create($validate);        
        
        $this->resetInput();        
    	$this->emit('alert', ['type' => 'success', 'message' => 'Tipo de Pagó creado']);
        
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

    public function update()
    {
        can('payment update'); 

        $validate = $this->validate();

        if ($this->selected_id) {
    		$record = Payment::find($this->selected_id);
            $record->update($validate);

            $this->resetInput();            
    		$this->emit('alert', ['type' => 'success', 'message' => 'Tipo de pagó actualizado']);
        }
    }
}
