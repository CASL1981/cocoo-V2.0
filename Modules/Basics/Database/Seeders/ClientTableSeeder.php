<?php

namespace Modules\Basics\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Basics\Entities\Client;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Client::factory(80)->create();

        Client::factory()->create([
            'identification' => 890300466,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'TECNOQUIMICA SA',
            'type_document' => 'NIT',
            'type' => 'Proveedor'
        ]);
        Client::factory()->create([
            'identification' => 901101292,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'TECNOLOGIA PLUS SAS',
            'type_document' => 'NIT',
            'type' => 'Proveedor'
        ]);
        Client::factory()->create([
            'identification' => 900419912,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'GRUPO ESCOM SAS',
            'type_document' => 'NIT',
            'type' => 'Proveedor'
        ]);
        Client::factory()->create([
            'identification' => 800249656,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'MUNDIAL DE MUEBLES PLUS SAS',
            'type_document' => 'NIT',
            'type' => 'Proveedor'
        ]);
        Client::factory()->create([
            'identification' => 901356120,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'SINERGIA INFORMATICA SAS',
            'type_document' => 'NIT',
            'type' => 'Proveedor'
        ]);
        Client::factory()->create([
            'identification' => 900013663,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'TRS PARTES SAS',
            'type_document' => 'NIT',
            'type' => 'Proveedor'
        ]);
        Client::factory()->create([
            'identification' => 830513067,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'MONITOREO INTELIGENT',
            'type_document' => 'NIT',
            'type' => 'Proveedor'
        ]);
        Client::factory()->create([
            'identification' => 901098182,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'SUMINISTROS Y PAPELERIAS DE LA COSTA SAS',
            'type_document' => 'NIT',
            'type' => 'Proveedor'
        ]);
        Client::factory()->create([
            'identification' => 811006823,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'DATAWARE SISTEMAS SAS',
            'type_document' => 'NIT',
            'type' => 'Proveedor'
        ]);
        Client::factory()->create([
            'identification' => 92521545,
            'first_name' => 'ESTEBAN RAFAEL',
            'last_name' => 'URUETA GONZALEZ',
            'client_name' => '',
            'type_document' => 'CC',
            'type' => 'Proveedor'
        ]);
    }
}
