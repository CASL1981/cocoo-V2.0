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

        Client::factory(80)->create();

        Client::factory()->create([
            'identification' => 78748131,
            'first_name' => 'SAMIR HERNANDO',
            'last_name' => 'MENDEZ PEREZ',
            'client_name' => '',
            'type_document' => 'CC',
            'type' => 'Cliente'
        ]);
        Client::factory()->create([
            'identification' => 800193912,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'ESE HOSPITAL SAN RAFAEL',
            'type_document' => 'NIT',
            'type' => 'Cliente'
        ]);
        Client::factory()->create([
            'identification' => 800250634,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'MEDICINA INTEGRAL SA',
            'type_document' => 'NIT',
            'type' => 'Cliente'
        ]);
        Client::factory()->create([
            'identification' => 812001793,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'IPS SALUMED LTDA',
            'type_document' => 'NIT',
            'type' => 'Cliente'
        ]);
        Client::factory()->create([
            'identification' => 812002284,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'IPS MEDICOR LTDA',
            'type_document' => 'NIT',
            'type' => 'Cliente'
        ]);
        Client::factory()->create([
            'identification' => 812003851,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'ESE HOSPITAL SAN JUAN DE SAHAGUN',
            'type_document' => 'NIT',
            'type' => 'Cliente'
        ]);
        Client::factory()->create([
            'identification' => 812004789,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'PEREZ Y PEREZ LTDA',
            'type_document' => 'NIT',
            'type' => 'Cliente'
        ]);
        Client::factory()->create([
            'identification' => 823004710,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'IPS DE LA COSTA SA',
            'type_document' => 'NIT',
            'type' => 'Cliente'
        ]);
        Client::factory()->create([
            'identification' => 891001122,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'CLINICA MONTERIA',
            'type_document' => 'NIT',
            'type' => 'Cliente'
        ]);
        Client::factory()->create([
            'identification' => 891079999,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'ESE HOSPITAL SAN JERONIMO',
            'type_document' => 'NIT',
            'type' => 'Cliente'
        ]);
        Client::factory()->create([
            'identification' => 900090247,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'CENTRO CARDIO INFANTIL IPS SAS',
            'type_document' => 'NIT',
            'type' => 'Cliente'
        ]);
        Client::factory()->create([
            'identification' => 900202883,
            'first_name' => '',
            'last_name' => '',
            'client_name' => 'CLINICA BIJAO IPS LTDA',
            'type_document' => 'NIT',
            'type' => 'Cliente'
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
