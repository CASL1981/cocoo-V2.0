<?php

namespace Modules\Orders\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class OrdersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ProductTableSeeder::class);
        $this->call(TypePriceTableSeeder::class);
        $this->call(PriceTableSeeder::class);
        $this->call(OperationTableSeeder::class);
    }
}
