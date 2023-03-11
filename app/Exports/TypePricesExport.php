<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Basics\Entities\TypePrice;

class TypePricesExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;
    
    private $type_prices;

    public function __construct($type_prices = null)
    {
        $this->type_prices = $type_prices;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->type_prices ?: TypePrice::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Nombre', 
            'Incremento', 
            'Taxa', 
            'Estado',
            'Tipo',
            'Minimo',
            'Maximo',
        ];
    }
}
