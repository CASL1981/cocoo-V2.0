<?php

namespace Modules\Orders\Http\Livewire;

use App\Traits\CRUDLivewireTrait;
use App\Traits\TableLivewire;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\Client;
use Modules\Basics\Entities\TypePrice;
use Modules\Orders\Entities\Price;
use Modules\Orders\Entities\Product;

class Prices extends Component
{
    use WithPagination;
    use TableLivewire;
    use CRUDLivewireTrait;

    public $order_product_id, $basic_client_id, $basic_type_price_id, $date, $value;    

    public $providers, $typeprices, $products;
    
    protected $listeners = ['showaudit','deleteItem', 'toggleProduct', 'processItem', 'reverseItem'];

    public function hydrate()
    {   
        $this->providers = Client::where('type', 'Proveedor')->where('status', true)->pluck('client_name', 'id')->toArray();
        
        $this->typeprices = TypePrice::where('status', 'Open')->pluck('name', 'id')->toArray();
        
        $this->products = Product::where('status', 'Open')->pluck('name', 'id')->toArray();

        $this->permissionModel = 'price';
        
        $this->messageModel = 'Precio';

        $this->model = 'Modules\Orders\Entities\Price';
        $this->exportable ='App\Exports\PriceExport';
    }

    protected function rules() 
    {
        return [            
            'order_product_id' => ['required'],
            'basic_client_id' => ['required'],
            'basic_type_price_id' => ['required'],
            'date' => 'nullable|date',
            'value' => 'required|numeric',            
        ];
    }  

    public function render()
    {
        $this->bulkDisabled = count($this->selectedModel) < 1;

        $prices = new Price();

        $prices = $prices->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)->paginate(20);        
        
        return view('orders::livewire.price.view', compact('prices'));        
    }

    public function edit()
    {   
        can('price update'); 
         
        $record = Price::findOrFail($this->selected_id);           
        
        $this->order_product_id = $record->order_product_id;
        $this->basic_client_id = $record->basic_client_id;
        $this->basic_type_price_id = $record->basic_type_price_id;
        $this->date = $record->date;        
        $this->value = $record->value;        

        $this->show = true;
    }

    public function store()
    {   
        can('price create');

        $validate = $this->validate();

        
        $validate = $this->addFillableValidation($validate);
        
        Price::create($validate);        
        
        $this->resetInput();        
    	$this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' creada']);
        
    }

    public function update()
    {
        can('price update'); 

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
        $product_name = Product::whereId($this->order_product_id)->first();
        
        return $validate = array_merge($validate, ['order_product_name' => $product_name->name]);
    }
}
