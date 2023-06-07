<?php

namespace Modules\Orders\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Modules\Orders\Entities\DetailOperation;
use Modules\Orders\Entities\Operation;
use Modules\Orders\Entities\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $fecha = Carbon::now();

        $orderShopping = Operation::whereMonth('date', $fecha->month)->whereYear('date', $fecha->year)->count();
        $orderLast = Operation::select('date', 'id', 'updated_at')->orderByDesc('created_at')->first();
        $orderPenddingRecibir = Operation::select('basic_client_name', 'id')->where('recibido', 0)->limit(10)->get();
        $ordersLasts = Operation::select('basic_client_name', 'total')->orderByDesc('created_at')->limit(10)->get();
        // $employees = Employee::count();
        // $clients = Client::count();

        return view('orders::index', compact([
            'orderShopping',
            'orderLast',
            'orderPenddingRecibir',
            'ordersLasts'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('orders::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function uploadImageProduct(Product $product)
    {
        // validamos el tipo de archivos y el tamaño de la imagen
        $this->validate(request(),[
            'images' => 'required|image|max:2048|dimensions:min_width=1680,min_height=900',
        ]);

        //capturamos el achivo enviado
        $image = request()->file('images')->store('news');

        $product->image = $image;
        $product->save();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('orders::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('orders::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function pdf($Operation)
    {
        //consultamos la información de la orden de compra
        $order = Operation::with('clients')->where('id', $Operation)->get()->toArray();

        //consultamos el detalle de la orden de compra
        $detailOrder = DetailOperation::where('order_operation_id', $Operation)->get()->toArray();

        //generamos la cantidad de paginas del PDF de la orden
        $paginas = $this->getPaginas(count($detailOrder));

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('orders::Pdf.operation', compact('order', 'detailOrder', 'paginas'));
        $pdf->setPaper('letter');
        return $pdf->stream();

    }

    public function getPaginas($detailOrder):int
    {
        $quantityRow = $detailOrder / 16;

        $parteDecimal = $quantityRow - floor($quantityRow);

        return $parteDecimal > 0 ? $quantityRow + (1 - $parteDecimal) : $quantityRow;
    }
}
