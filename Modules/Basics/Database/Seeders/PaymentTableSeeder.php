<?php

namespace Modules\Basics\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Basics\Entities\Payment;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Payment::factory()->create([
            'name' => 'CONTADO PROVEEDORES',
            'quotas' => 0,
            'typeinterval' => 'D',
            'interval' => 1,
        ]);
        Payment::factory()->create([
            'name' => 'CONTADO CLIENTES',
            'quotas' => 0,
            'typeinterval' => 'D',
            'interval' => 1,
        ]);
        Payment::factory()->create([
            'name' => '10 DÍAS',
            'quotas' => 0,
            'typeinterval' => 'D',
            'interval' => 10,
        ]);
        Payment::factory()->create([
            'name' => '30 DÍAS',
            'quotas' => 0,
            'typeinterval' => 'M',
            'interval' => 1,
        ]);
        Payment::factory()->create([
            'name' => '45 DÍAS',
            'quotas' => 0,
            'typeinterval' => 'D',
            'interval' => 45,
        ]);
        Payment::factory()->create([
            'name' => '60 DÍAS',
            'quotas' => 0,
            'typeinterval' => 'M',
            'interval' => 2,
        ]);
    }
}
