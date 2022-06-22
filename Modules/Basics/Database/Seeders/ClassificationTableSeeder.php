<?php

namespace Modules\Basics\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Basics\Entities\Classification;

class ClassificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();        

        Classification::factory()->create([
            'code' => 'PAP',
            'level' => 1,
            'parent' => 'PAP',
            'name' => 'PAPALERIA',
            'impute' => true,
        ]);
        Classification::factory()->create([
            'code' => 'ASE',
            'level' => 1,
            'parent' => 'ASE',
            'name' => 'ASEO',
            'impute' => true,
        ]);
        Classification::factory()->create([
            'code' => 'COM',
            'level' => 1,
            'parent' => 'COM',
            'name' => 'EQUIPOS DE COMPUTO',
            'impute' => true,
        ]);
        Classification::factory()->create([
            'code' => 'CEL',
            'level' => 1,
            'parent' => 'CEL',
            'name' => 'TELEFONOS Y CELULARES',
            'impute' => true,
        ]);
    }
}
