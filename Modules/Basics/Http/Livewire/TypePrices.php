<?php

namespace Modules\Basics\Http\Livewire;

use App\Traits\CRUDLivewireTrait;
use App\Traits\TableLivewire;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\TypePrice;

class TypePrices extends Component
{    
    use WithPagination;
    use TableLivewire;
    use CRUDLivewireTrait;

    public $name, $increment, $tax, $status, $type, $minimum, $maximum;    
    
    
    protected $listeners = ['showaudit','deleteItem', 'toggleItem', 'reverseItem'];

    public function hydrate()
    {   
        $this->permissionModel = 'typeprice';
        
        $this->messageModel = 'Lista de Precio';

        $this->model = 'Modules\Basics\Entities\TypePrice';
        $this->exportable ='App\Exports\TypePricesExport';
    }

    protected function rules() 
    {
        return [        
            'name' => ['required', 'max:100', Rule::unique('order_products')->ignore($this->selected_id)],
            'increment' => 'nullable|numeric|max:100',
            'tax' => ['nullable', Rule::in(['0', '1'])],
            'type' => ['nullable', Rule::in(['FIJO', 'VARIABLE'])],
            'minimum' => 'nullable|numeric',
            'maximum' => 'nullable|numeric',
        ];
    }
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectedModel) < 1;

        $typeprices = new TypePrice();

        $typeprices = $typeprices->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)->paginate(20);
        
        return view('basics::livewire.typeprice.view', compact('typeprices'));
        
    }

    public function edit()
    {   
        can('typeprice update'); 

        $record = TypePrice::findOrFail($this->selected_id);           
        
        $this->name = $record->name;
        $this->increment = $record->increment;
        $this->tax = $record->tax;
        $this->type = $record->type;        
        $this->minimum = $record->minimum;
        $this->maximum = $record->maximum;        

        $this->show = true;
    }
}
