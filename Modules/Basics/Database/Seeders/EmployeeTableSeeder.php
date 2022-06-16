<?php

namespace Modules\Basics\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Basics\Entities\Employee;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Employee::factory(30)->create();

        Employee::factory()->create([
            'identification' => 7383633,
            'first_name' => 'CARLOS ARTURO',
            'last_name' => 'SIBAJA LOPEZ',
            'type_document' => 'CC',
        ]);
        Employee::factory()->create([
            'identification' => 50986771,
            'first_name' => 'KELLY PAOLA',
            'last_name' => 'PETRO HERNANDEZ',
            'type_document' => 'CC',
        ]);
        Employee::factory()->create([
            'identification' => 1067912234,
            'first_name' => 'STEFANIA',
            'last_name' => 'BOLAÑO PEREZ',
            'type_document' => 'CC',
        ]);
        Employee::factory()->create([
            'identification' => 1067881460,
            'first_name' => 'ANA PAOLA',
            'last_name' => 'ACOSTA ESTRADA',
            'type_document' => 'CC',
        ]);
        Employee::factory()->create([
            'identification' => 78714917,
            'first_name' => 'FERNANDO ANTONIO',
            'last_name' => 'BERROCAL NEGRETE',
            'type_document' => 'CC',
        ]);
        Employee::factory()->create([
            'identification' => 34978225,
            'first_name' => 'ELSY LUCIA',
            'last_name' => 'CANO LOPEZ',
            'type_document' => 'CC',
        ]);
        Employee::factory()->create([
            'identification' => 1143365495,
            'first_name' => 'ARIANA GISELA',
            'last_name' => 'CANTERO MUÑOZ',
            'type_document' => 'CC',
        ]);
        Employee::factory()->create([
            'identification' => 10767468,
            'first_name' => 'CARLOS ANDRES',
            'last_name' => 'MARTINEZ ALMANZA',
            'type_document' => 'CC',
        ]);
        Employee::factory()->create([
            'identification' => 1067891523,
            'first_name' => 'TANIA MABEL',
            'last_name' => 'MARTINEZ HERNANDEZ',
            'type_document' => 'CC',
        ]);       
        
    }
}
