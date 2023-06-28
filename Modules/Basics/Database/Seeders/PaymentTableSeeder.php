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
            'name' => 'CONTADO',
            'quotas' => 0,
            'typeinterval' => 'D',
            'interval' => 1,
        ]);
        Payment::factory()->create([
            'name' => 'CREDITO',
            'quotas' => 0,
            'typeinterval' => 'D',
            'interval' => 1,
        ]);
        Payment::factory()->create([
            'name' => 'ANTICIPO',
            'quotas' => 0,
            'typeinterval' => 'D',
            'interval' => 1,
        ]);
    }
}
