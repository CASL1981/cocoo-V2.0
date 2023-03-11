<?php

namespace Modules\Basics\Http\Livewire;

use App\Traits\CRUDLivewireTrait;
use App\Traits\TableLivewire;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\Sequence as EntitiesSequence;

class Sequence extends Component
{
    use WithPagination;
    use TableLivewire;
    use CRUDLivewireTrait;

    public $document_name, $document, $number;

    protected $listeners = ['showaudit','deleteItem'];

    public function hydrate()
    {   //variable que determina el permiso del modelo
        $this->permissionModel = 'sequence';
        
        //menaje de la acción del Tait
        $this->messageModel = 'Secuencia de documentos';

        //propiedad que asigna el modelo al Trait CRUDLivewire
        $this->model = 'Modules\Basics\Entities\Sequence';

        //Asignamos la clase para exportar a EXCEL
        $this->exportable ='App\Exports\PaymentsExport';
    }
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectedModel) < 1;

        $sequences = new EntitiesSequence();

        $sequences = $sequences->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)->paginate(10);

        return view('basics::livewire.sequence.view', compact('sequences'));
    }

    protected function rules() 
    {
        return [        
            'document' => 'required|min:1|max:3',
            'document_name' => 'required|min:5|max:100',
            'number' => 'required|numeric',
        ];
    }

    public function edit()
    {   
        can('sequence update'); 

        $record = $this->model::findOrFail($this->selected_id);           
        
        $this->document = $record->document;
        $this->document_name = $record->document_name;        
        $this->number = $record->number;

        $this->show = true;
    }
    
    // Modificamos la funacion del Trait TableLivewire
    public function deleteItem()
    {
        can('sequence delete');

        $product = $this->model::find($this->selected_id);
        if($product) {            
            $product->delete();
            $this->resetInput();
            $this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' Anulado']);            
        } else {
            $this->resetInput();
            $this->emit('alert', ['type' => 'warning', 'message' => $this->messageModel . ' ya esta Anulado no se puede Eliminar']);
        }        
    
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
