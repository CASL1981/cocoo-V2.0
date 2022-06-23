<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Orders\Entities\Price;

class PriceExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;
    
    private $prices;

    public function __construct($prices = null)
    {
        $this->prices = $prices;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->prices ?: Price::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'ProductoId', 
            'ProveedorId', 
            'CategoriaId', 
            'Fecha',
            'Valor',
        ];
    }
}
