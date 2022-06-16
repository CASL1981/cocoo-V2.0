<?php

namespace Modules\Basics\Http\Livewire;

use App\Traits\TableLivewire;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\Destination;

class Destinations extends Component
{
    use WithPagination;
    use TableLivewire;

    public $costcenter, $name, $address, $phone, $location, $minimun, $maximun;
    
    protected $listeners = 'showaudit';

    public function mount()
    {                   
        $this->model = 'Modules\Basics\Entities\Destination';
        $this->exportable ='App\Exports\DestinationsExport';
    }

    protected function rules() 
    {
        return [
            'costcenter' => 'required', 
            'name' => 'required|min:3|max:100',
            'address' => 'nullable', 
            'phone' => 'nullable',
            'location' => 'nullable', 
            'minimun' => 'nullable|numeric',
            'maximun' => 'nullable|numeric'
        ];
    }
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectedModel) < 1;

        $destinations = new Destination();

        $destinations = $destinations->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)->paginate(10);

        return view('basics::livewire.destination.view', compact('destinations'));
    }

    public function store()
    {   
        can('destination create'); 

        $validate = $this->validate();    	
        
        Destination::create($validate);        
        
        $this->resetInput();        
    	$this->emit('alert', ['type' => 'success', 'message' => 'Destination creado']);
        
    }

    public function edit()
    {   
        can('destination update'); 

        $record = Destination::findOrFail($this->selected_id);
            	
        $this->costcenter = $record->costcenter;
        $this->name = $record->name;
        $this->address = $record->address;
        $this->phone = $record->phone;
        $this->location = $record->location;
        $this->minimun = $record->minimun;
        $this->maximun = $record->maximun;

        $this->show = true;
    }

    public function update()
    {
        can('destination update'); 

        $validate = $this->validate();

        if ($this->selected_id) {
    		$record = Destination::find($this->selected_id);
            $record->update($validate);

            $this->resetInput();            
    		$this->emit('alert', ['type' => 'success', 'message' => 'Destination actualizado']);
        }
    }  

}
