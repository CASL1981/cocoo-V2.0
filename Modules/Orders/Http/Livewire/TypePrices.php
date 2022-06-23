<?php

namespace Modules\Orders\Http\Livewire;

use App\Traits\TableLivewire;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
// use Modules\Orders\Entities\TypePrice as EntitiesTypePrice;
use Modules\Orders\Entities\TypePrice;

class TypePrices extends Component
{    
    use WithPagination;
    use TableLivewire;

    public $name, $increment, $tax, $status, $type, $minimum, $maximum;    
    
    
    protected $listeners = ['showaudit','deleteTypePrice', 'toggleTypePrice'];

    public function mount()
    {   
        $this->model = 'Modules\Orders\Entities\TypePrice';
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

        $typeprices = $typeprices->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)
                    ->paginate(20);        

        return view('orders::livewire.typeprice.view', compact('typeprices'));
        
    }

    
    public function store()
    {   
        can('typeprice create');

        $validate = $this->validate();    	
        
        TypePrice::create($validate);
        
        $this->resetInput();        
    	$this->emit('alert', ['type' => 'success', 'message' => 'Lista de precio creada']);
        
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

    public function update()
    {
        can('typeprice update'); 

        $validate = $this->validate();

        if ($this->selected_id) {
    		$record = TypePrice::find($this->selected_id);
            $record->update($validate);

            $this->resetInput();            
    		$this->emit('alert', ['type' => 'success', 'message' => 'Lista de precio actualizada']);
        }
    }

    public function deleteTypePrice()
    {
        can('typeprice delete');

        if ($this->selected_id ) {
            $item = TypePrice::find($this->selected_id);
            
            $item->delete();
            $this->resetInput();
            $this->emit('alert', ['type' => 'success', 'message' => 'Lista de precio Eliminada']);            
        }
    }

    public function toggleTypePrice()
    {
        can('typeprice toggle');        

        if (count($this->selectedModel)) {
            //consultamos todos los status y consultamos los modelos de los productos seleccionado
            $status = TypePrice::whereIn('id', $this->selectedModel)->get('status')->toArray();
            $record = TypePrice::whereIn('id', $this->selectedModel);            
            
            if($status[0]['status']) {
                $record->update([ 'status' => false ]); //actualizamos los modelos
                
                $this->selectedModel = []; //limpiamos todos los productos seleccionados
                $this->selectAll = false;
            } else {
                $record->update([ 'status' => true ]);
                
                $this->selectedModel = [];
                $this->selectAll = false;
            }
        } else {
            $this->emit('alert', ['type' => 'warning', 'message' => 'Selecciona un Item']);
        }
    }
}
