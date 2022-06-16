<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Basics\Entities\Payment;

class PaymentsExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;
    
    private $payments;

    public function __construct($payments = null)
    {
        $this->payments = $payments;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->payments ?: Payment::all();
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
