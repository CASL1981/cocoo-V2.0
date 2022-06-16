<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Basics\Entities\Employee;

class EmployeesExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;
    
    private $employess;

    public function __construct($employess = null)
    {
        $this->employess = $employess;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->employess ?: Employee::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Identificaión', 
            'Nombres', 
            'Apellidos',
            'Estado', 
            'Documento',                         
            'Dirección', 
            'Telefono', 
            'Celular', 
            'FechaIngreso',
            'Email', 
            'Genero', 
            'FechaNacimiento',              
            'Localización',
        ];
    }  
}
