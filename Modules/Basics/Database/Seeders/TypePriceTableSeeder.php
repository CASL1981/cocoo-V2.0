<?php

namespace Modules\Basics\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Basics\Entities\TypePrice;

class TypePriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // TypePrice::factory(20)->create();

        TypePrice::factory()->create(['name' => 'PAPALERIA']);
        TypePrice::factory()->create(['name' => 'EQUIPOS DE COMPUTO']);
        TypePrice::factory()->create(['name' => 'SUMINISTROS VEHICULO']);
        TypePrice::factory()->create(['name' => 'ASEO Y CAFETERIA']);
    }
}
