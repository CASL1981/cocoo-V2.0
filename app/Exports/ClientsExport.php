<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Basics\Entities\Client;

class ClientsExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;

    private $clients;

    public function __construct($clients = null)
    {
        $this->clients = $clients;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->clients ?: Client::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Identificion', 
            'Nombres', 
            'Apellidos', 
            'razon social',
            'Estado', 
            'Documento', 
            'Dirección', 
            'Telefono', 
            'Celular', 
            'FechaIngreso', 
            'Email', 
            'Genero',
            'FechaNacimiento', 
            'Cupo',            
            'Vendedor', 
            'ListaPrecio', 
            'Contacto',
            'FormaPago',
        ];
    }    
}
