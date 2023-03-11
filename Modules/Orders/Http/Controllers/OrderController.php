<?php

namespace Modules\Orders\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Modules\Orders\Entities\DetailOperation;
use Modules\Orders\Entities\Operation;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // $centercost = Destination::count();
        // $employees = Employee::count();
        // $clients = Client::count();

        return view('orders::index');
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
    public function store(Request $request)
    {
        //
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
        $order = Operation::where('id', $Operation)->get()->toArray();
        
        $detailOrder = DetailOperation::where('order_operation_id', $Operation)->get()->toArray();

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
