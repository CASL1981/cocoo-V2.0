<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Orders\Entities\Operation;

class OperationExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;
    
    private $operations;

    public function __construct($operations = null)
    {
        $this->operations = $operations;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->operations ?: Operation::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Fecha',             
            'Estatus', 
            'proveedor',
            'Plazo',
            'Observaciones',
            'Lista Precio',
            'Aprovado',
            'Revisado',
            'Clasificación',
        ];
    } 
}
