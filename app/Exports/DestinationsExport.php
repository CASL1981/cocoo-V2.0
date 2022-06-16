<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Basics\Entities\Destination;

class DestinationsExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;

    private $destinations;

    public function __construct($destinations = null)
    {
        $this->destinations = $destinations;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->destinations ?: Destination::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Centro Costo', 
            'Descripción', 
            'Dirección', 
            'Telefono', 
            'Localización', 
            'Minimo', 
            'Maximo'
        ];
    }  
}
