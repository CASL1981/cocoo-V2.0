<?php

namespace Modules\Basics\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Basics\Entities\Destination;

class DestinationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Destination::factory()->create([
            'costcenter' => 1,
            'name' => 'OFICINA PRINCIPAL'
        ]);
        Destination::factory()->create([
            'costcenter' => 1100,
            'name' => 'FARMACIA VALENCIA'
        ]);
        Destination::factory()->create([
            'costcenter' => 1200,
            'name' => 'FARMACIA LORICA'
        ]);
        Destination::factory()->create([
            'costcenter' => 1300,
            'name' => 'FARMACIA MONTELIBANO'
        ]);
        Destination::factory()->create([
            'costcenter' => 1400,
            'name' => 'FARMACIAS MONTERIA'
        ]);
        Destination::factory()->create([
            'costcenter' => 1500,
            'name' => 'FARMACIA PLANETA RICA'
        ]);
        Destination::factory()->create([
            'costcenter' => 1600,
            'name' => 'FARMACIA SAN ANTERO'
        ]);
    }
}
