<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Orders\Entities\Product;

class ProductExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;
    
    private $products;

    public function __construct($products = null)
    {
        $this->products = $products;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->products ?: Product::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'name', 
            'Impuesto', 
            'Estatus', 
            'proveedor',
            'porcentaje',
            'marca',
            'Unidad Medida',
            'clasificación',
            'imagen',
        ];
    } 
}
