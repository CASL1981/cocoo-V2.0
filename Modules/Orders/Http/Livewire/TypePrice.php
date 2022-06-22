<?php

namespace Modules\Orders\Http\Livewire;

use Livewire\Component;

class TypePrice extends Component
{
    public function render()
    {
        return view('orders::livewire.typeprice.view');
    }

    // use WithPagination;
    // use TableLivewire;

    // public $code, $level, $parent, $name, $impute;
    
    // protected $listeners = ['showaudit','deleteClassification'];

    // public function mount()
    // {                   
    //     $this->model = 'Modules\Basics\Entities\Classification';
    //     $this->exportable ='App\Exports\ClassificationsExport';
    // }

    // protected function rules() 
    // {
    //     return [        
    //         'code' => ['required', 'max:10', Rule::unique('basic_classifications')->ignore($this->selected_id)],
    //         'level' => 'nullable|numeric', 
    //         'parent' => 'nullable|min:1|max:10',
    //         'name' => 'required|min:3|max:100',
    //         'impute' => ['nullable', Rule::in(['0', '1'])],
    //     ];
    // }
    
    // public function render()
    // {
    //     $this->bulkDisabled = count($this->selectedModel) < 1;

    //     $classifications = new Classification();

    //     $classifications = $classifications->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)->paginate(20);        

    //     return view('basics::livewire.classification.view', compact('classifications'));
        
    // }

    
    // public function store()
    // {   
    //     can('classification create');

    //     $validate = $this->validate();    	
        
    //     Classification::create($validate);
        
    //     $this->resetInput();        
    // 	$this->emit('alert', ['type' => 'success', 'message' => 'Clasificación creada']);
        
    // }

    // public function edit()
    // {   
    //     can('classification update'); 

    //     $record = Classification::findOrFail($this->selected_id);           
        
    //     $this->code = $record->code;
    //     $this->level = $record->level;
    //     $this->parent = $record->parent;        
    //     $this->name = $record->name;
    //     $this->impute = $record->impute;

    //     $this->show = true;
    // }

    // public function update()
    // {
    //     can('classification update'); 

    //     $validate = $this->validate();

    //     if ($this->selected_id) {
    // 		$record = Classification::find($this->selected_id);
    //         $record->update($validate);

    //         $this->resetInput();            
    // 		$this->emit('alert', ['type' => 'success', 'message' => 'Tipo de pagó actualizado']);
    //     }
    // }

    // public function deleteClassification()
    // {
    //     can('classification delete');

    //     if ($this->selected_id ) {
    //         $classification = Classification::find($this->selected_id);
            
    //         $classification->delete();
    //         $this->emit('alert', ['type' => 'success', 'message' => 'classification Eliminado']);            
    //     }
    // }
}
