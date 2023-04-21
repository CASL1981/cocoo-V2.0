<?php

namespace Modules\Basics\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BasicsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(DestinationTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(ClassificationTableSeeder::class);
        $this->call(TypePriceTableSeeder::class);
    }
}
