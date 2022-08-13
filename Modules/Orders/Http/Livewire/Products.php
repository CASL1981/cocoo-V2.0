<?php

namespace Modules\Orders\Http\Livewire;

use App\Traits\CRUDLivewireTrait;
use App\Traits\TableLivewire;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Basics\Entities\Classification;
use Modules\Basics\Entities\Client;
use Modules\Orders\Entities\Product;

class Products extends Component
{
    use WithPagination;
    use TableLivewire;
    use CRUDLivewireTrait;

    public $name, $tax, $status, $basic_client_id, $tax_percentage, $brand, $measure_unit;
    public $basic_classification_id, $image;

    public $providers, $categories;
    
    protected $listeners = ['showaudit','deleteItem', 'toggleItem', 'reverseItem'];

    public function hydrate()
    {   
        $this->providers = Client::where('type', 'Proveedor')->where('status', true)->pluck('client_name', 'id')->toArray();

        $this->categories = Classification::where('impute', true)->pluck('name', 'id')->toArray();

        $this->permissionModel = 'product';
        
        $this->messageModel = 'Producto';

        $this->model = 'Modules\Orders\Entities\Product';
        $this->exportable ='App\Exports\ProductsExport';
    }

    protected function rules() 
    {
        return [        
            'name' => ['required', 'max:100', Rule::unique('order_products')->ignore($this->selected_id)],
            'tax' => ['nullable', Rule::in(['0', '1'])],
            'basic_client_id' => ['required'],
            'brand' => 'nullable|min:2|max:100',
            'tax_percentage' => 'nullable|numeric',
            'measure_unit' => 'nullable|min:2|max:100',
            'basic_classification_id' => ['required'],
            'image' => 'nullable|image:jpg,png|max:2048',
        ];
    }
    
    public function render()
    {
        $this->bulkDisabled = count($this->selectedModel) < 1;

        $products = new Product();

        $products = $products->QueryTable($this->keyWord, $this->sortField, $this->sortDirection)
                    ->paginate(20);
        
        return view('orders::livewire.product.view', compact('products'));        
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
}
