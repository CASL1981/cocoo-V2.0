<?php

namespace Modules\Orders\Http\Livewire;

use App\Traits\CRUDLivewireTrait;
use App\Traits\TableLivewire;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Orders\Entities\DetailOperation;
use Modules\Orders\Entities\Operation;

class EditDetailOperations extends Component
{
    use WithPagination;
    use TableLivewire;
    use CRUDLivewireTrait;

    public $product_name, $quantity, $price, $discount, $discount_percentage, $subtotal, $tax_sale, $tax_sale_percentage, $total;

    public $measure_unitd, $brand, $received, $order_operation_id, $basic_destination_id, $operations;
    
    public $searchOrder;

    public $showSearch = false;

    // protected $listeners = ['showaudit','deleteItem', 'toggleItem', 'processItem', 'reverseItem', 'detailOrder', 'pdfOrder'];

    public function hydrate()
    {
        $this->permissionModel = 'operation';
        
        $this->messageModel = 'Detalle de Orden';

        $this->model = 'Modules\Orders\Entities\DetailOperation';
        $this->exportable ='App\Exports\OperationExport';
    }

    protected function rules() 
    {
        return [        
            'product_name' => 'required|min:3|string',
            'quantity' => 'required|numeric' ,
            'price' => 'required|numeric',
            'discount' => 'nullable|min:1|numeric',
            'discount_percentage' => 'nullable|min:1|numeric',
            'subtotal' => 'required|numeric',
            'tax_sale' => 'required|numeric',
            'tax_sale_percentage' => 'required|numeric',
            'total' =>  'required|numeric',
            'measure_unitd' => 'required|string',
            'brand' => 'nullable|string',
        ];
    }
    
    public function render()
    {
        $detail_order = new DetailOperation();

        $detail_order = $detail_order->QueryTable($this->keyWord, $this->sortField, $this->sortDirection, $this->searchOrder)
                    ->paginate(20);

        $operations = Operation::all();

        // dd($operations);

        return view('orders::livewire.editdetailoperation.view', compact('detail_order'));
    }

    public function edit()
    {   
        // can('detailoperation update'); 

        $record = DetailOperation::findOrFail($this->selected_id);

        if($record->status !== 'Open'){
            $this->resetInput();
            return $this->emit('alert', ['type' => 'warning', 'message' => 'Orden NO está Abierta']);
        }
        
        $this->product_name = $record->product_name;
        $this->quantity = $record->quantity;
        $this->price = $record->price;
        $this->discount = $record->discount;
        $this->discount_percentage = $record->discount_percentage;
        $this->subtotal = $record->subtotal;        
        $this->tax_sale = $record->tax_sale;
        $this->tax_sale_percentage = $record->tax_sale_percentage;
        $this->total = $record->total;
        $this->measure_unitd = $record->measure_unitd;
        $this->brand = $record->brand;        

        $this->show = true;
    }
    /** Actualizamos el detalle de la orden */
    public function update()
    {
        can($this->permissionModel . ' update'); 

        $validate = $this->validate();

        if ($this->selected_id) {
    		$record = $this->model::find($this->selected_id);
            $record->update($validate);

            $this->resetExcept(['model', 'exportable', 'keyWord', 'permissionModel', 'messageModel', 'model', 'searchOrder']);
            $this->show = false;
    		$this->emit('alert', ['type' => 'success', 'message' => $this->messageModel . ' actualizada']);
        }
    }

    /** show modal search */

    public function showModalSearch()
    {
        $this->showSearch = true;
    }

    /** closed modal search */
    public function closedModalSearch()
    {
        $this->showSearch = false;
    }
}
