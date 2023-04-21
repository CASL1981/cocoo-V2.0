<?php

namespace Modules\Orders\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use Modules\Basics\Entities\Client;
use Modules\Basics\Entities\Destination;
use Modules\Orders\Entities\DetailOperation;
use Modules\Orders\Entities\Operation;
use Modules\Orders\Entities\Price;
use Modules\Orders\Entities\Product;

class DetailOperations extends Component
{
    public $providers, $provider, $products, $destinations, $provider_id; //para la lista de productos

    public $order_id, $order, $payment, $type_price, $product_id;

    public $discount, $quantity, $basic_destination_id, $draft_quantity, $subtotal, $taxiva, $total;

    public $suma_quantity, $suma_value, $suma_discount, $value_bruto;

    public $selected_id, $tax, $itemtotal, $price, $tax_sale_percentage;


    public $orderProducts = [];// array de detalle de productos
    public $action = 1;

    public function mount(Request $request)
    {
        $this->providers = Client::where('type', 'Proveedor')->where('status', true)->pluck('client_name', 'id');
        $this->destinations = Destination::pluck('costcenter', 'costcenter');

        $this->products = [];

        $this->order_id = $request->session()->get('OrderId');

    }

    public function render()
    {
        $this->balanceOrder();

        $this->order = Operation::find($this->order_id);

        if($this->order)
        {
            $this->provider = Client::find($this->order->basic_client_id);
            $this->selected_id = $this->provider->id;
            $this->payment = $this->order->basic_payment_name;
            $this->type_price = $this->order->basic_type_price_name;
            $this->products = Price::where([
                'basic_client_id' => $this->provider->id,
                'basic_type_price_id' => $this->order->basic_type_price_id,
                'status' => 'Open'
            ])->pluck('order_product_name', 'id');

            $this->provider_id = $this->provider->id;

            return view('orders::livewire.detailoperation.view', [
                'products' => $this->products,
                'provider' => $this->provider_id,
                'orderProducts' => $this->orderProducts,
            ]);
        }else{
            return view('orders::livewire.detailoperation.view', [
                'products' => $this->products,
                'providers' => $this->provider_id,
                'orderProducts' => $this->orderProducts,
            ]);
        }
    }

    public function addProduct()
    {
        if($this->product_id == '' || $this->quantity == '' || $this->basic_destination_id == '')
        {
            $this->emit('alert', ['type' => 'warning', 'message' => 'Ingrese todos los campos para agregar un producto a la lista']);
        }else{
            $product = Price::find($this->product_id);
            $this->tax = Product::whereId($product->order_product_id)->first()->tax_percentage;

            $this->itemtotal = (floatval($this->quantity) * floatval($product->value)) - $this->discount;

            $subtotal = (floatval($product->value - $this->discount)) * floatval($this->quantity);
            $impuesto = round(($product->value - $this->discount) * $this->quantity * $this->tax/100);

            DetailOperation::create([
                'order_product_id' => $this->product_id,
                'product_name' => $product->order_product_name,
                'quantity' => $this->quantity,
                'price' => $product->value,
                'tax_sale' => $impuesto,
                'tax_sale_percentage' => $this->tax,
                'discount' => $this->discount,
                'discount_percentage' => $this->discount,
                'subtotal' => $subtotal,
                'total' => $subtotal + $impuesto,
                'measure_unitd' => Product::whereId($product->order_product_id)->first()->measure_unit,
                'received' => 0,
                'order_operation_id' => $this->order_id,
                'basic_destination_id' => $this->basic_destination_id,
                'itemtotal' => $this->itemtotal,
                'ivavalue' => round($this->itemtotal * $this->tax/100),
            ]);

            $this->resetInput();
        }
    }

    public function resetInput()
    {
        $this->product_id = '';
        $this->quantity = null;
        $this->discount = null;
        $this->basic_destination_id = null;
    }

    public function doAction($action)
    {
        $this->selected_id = $action;
    }

    public function removeItem($key)
    {
        DetailOperation::find($key)->delete();

        $this->balanceOrder();

        $this->emit('alert', ['type' => 'siccess', 'message' => 'Eliminado con éxito']);
    }

    public function editingItem($key)
    {
        $item = DetailOperation::find($key);

        $this->quantity = $item->quantity;
        $this->price = $item->price;
        $this->discount = $item->discount;
        $this->tax_sale_percentage = $item->tax_sale_percentage;

        $item->update(['status' => 'Editing']);
    }

    public function cancelEditingItem($key)
    {
        DetailOperation::find($key)->update(['status' => 'Open']);

        $this->resetInput();
    }

    public function updateEditingItem($key)
    {
        $item = DetailOperation::find($key);

        $item->update([
            'quantity' => $this->quantity,
            'subtotal' => $item->getSubTotalItem($this->quantity),
            'tax_sale' => $item->getTaxSaleItem(),
            'total' => $item->getTotalItem(),

            'status' => 'Open'
        ]);

        $this->resetInput();

        $this->balanceOrder();
    }

    public function storeOrder()
    {
        $this->validate([
            'provider_id'=>'required',
        ]);

        $this->order->update([
            'brute' => $this->value_bruto,
            'discount' => $this->suma_discount,
            'subtotal' => $this->subtotal,
            'tax_sale' => $this->taxiva,
            'total' => $this->total,
        ]);

        $this->resetInput();

        return redirect()->route('order.operation');
    }

    public function balanceOrder(): void
    {
        $this->orderProducts = DetailOperation::where("order_operation_id", $this->order_id)->get()->toArray();

        if($this->orderProducts)
        {
            $this->subtotal = DetailOperation::where("order_operation_id", $this->order_id)->sum('subtotal');
            $this->suma_quantity = DetailOperation::where("order_operation_id", $this->order_id)->sum('quantity');
            $this->suma_value = DetailOperation::where("order_operation_id", $this->order_id)->sum('price');
            $this->suma_discount = DetailOperation::where("order_operation_id", $this->order_id)->sum('discount');
            $this->value_bruto = $this->subtotal + $this->suma_discount;
            $this->taxiva = DetailOperation::where("order_operation_id", $this->order_id)->sum('tax_sale');
            $this->total = DetailOperation::where("order_operation_id", $this->order_id)->sum('total');
        }
    }

}
