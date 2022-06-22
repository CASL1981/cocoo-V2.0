<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Basics\Entities\Classification;

class ClassificationsExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;
    
    private $classifications;

    public function __construct($classifications = null)
    {
        $this->classifications = $classifications;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->classifications ?: Classification::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Descripción', 
            'Tipo', 
            'Cuota', 
            'Días',
        ];
    } 
}
