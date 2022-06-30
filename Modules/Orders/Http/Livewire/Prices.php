<?php

namespace Modules\Orders\Http\Livewire;

use App\Traits\TableLivewire;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\Client;
use Modules\Orders\Entities\Price;
use Modules\Orders\Entities\Product;
use Modules\Orders\Entities\TypePrice;

class Prices extends Component
{
    use WithPagination;
    use TableLivewire;

    public $order_product_id, $basic_client_id, $order_type_price_id, $date, $value;    

    public $providers, $typeprices, $products;
    
    protected $listeners = ['showaudit','deleteProduct', 'toggleProduct'];

    public function mount()
    {   
        $this->providers = Client::where('type', 'Proveedor')->where('status', true)
                        ->pluck('client_name', 'id')->toArray();

        $this->typeprices = TypePrice::where('status', true)
                        ->pluck('name', 'id')->toArray();

        $this->products = Product::where('status', true)
                        ->pluck('name', 'id')->toArray();

        $this->model = 'Modules\Orders\Entities\Price';
        $this->exportable ='App\Exports\PriceExport';
    }

    protected function rules() 
    {
        return [            
            'order_product_id' => ['required'],
            'basic_client_id' => ['required'],
            'order_type_price_id' => ['required'],
            'date' => 'nullable|date',
            'value' => 'required|numeric',            
        ];
    }
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectedModel) < 1;

        $prices = new Price();

        $prices = $prices->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)
                    ->paginate(20);        
        // dd($prices);
        return view('orders::livewire.price.view', compact('prices'));
        
    }

    
    public function store()
    {   
        can('product create');

        $validate = $this->validate();    	
        
        Product::create($validate);
        
        $this->resetInput();        
    	$this->emit('alert', ['type' => 'success', 'message' => 'Producto creado']);
        
    }

    public function edit()
    {   
        can('product update'); 

        $record = Product::findOrFail($this->selected_id);           
        
        $this->name = $record->name;
        $this->tax = $record->tax;
        $this->basic_client_id = $record->basic_client_id;
        $this->brand = $record->brand;        
        $this->tax_percentage = $record->tax_percentage;
        $this->measure_unit = $record->measure_unit;
        $this->basic_classification_id = $record->basic_classification_id;

        $this->show = true;
    }

    public function update()
    {
        can('product update'); 

        $validate = $this->validate();

        if ($this->selected_id) {
    		$record = Product::find($this->selected_id);
            $record->update($validate);

            $this->resetInput();            
    		$this->emit('alert', ['type' => 'success', 'message' => 'Producto actualizado']);
        }
    }

    public function deleteProduct()
    {
        can('product delete');

        if ($this->selected_id ) {
            $product = Product::find($this->selected_id);
            
            $product->delete();
            $this->emit('alert', ['type' => 'success', 'message' => 'Producto Eliminado']);            
        }
    }

    public function toggleProduct()
    {
        can('product toggle');        

        if (count($this->selectedModel)) {
            //consultamos todos los status y consultamos los modelos de los productos seleccionado
            $status = Product::whereIn('id', $this->selectedModel)->get('status')->toArray();
            $record = Product::whereIn('id', $this->selectedModel);            
            
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
            $this->emit('alert', ['type' => 'warning', 'message' => 'Selecciona un Producto']);
        }
    }
}
