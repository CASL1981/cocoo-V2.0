<?php

namespace Modules\Basics\Http\Livewire;

use App\Traits\CRUDLivewireTrait;
use App\Traits\TableLivewire;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\Destination;

class Destinations extends Component
{
    use WithPagination;
    use TableLivewire;
    use CRUDLivewireTrait;

    public $costcenter, $name, $address, $phone, $location, $minimun, $maximun;
    
    protected $listeners = 'showaudit';

    public function hydrate()
    {
        $this->permissionModel = 'destination';
        
        $this->messageModel = 'Centro de Costo';

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
