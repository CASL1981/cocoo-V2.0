<?php

namespace Modules\Orders\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Orders\Entities\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Product::factory(40)->create();

        Product::factory()->create([
            'name' => 'JABON LIQUIDO',
            'basic_client_id' => 8,
            'tax_percentage' => 19,
            'brand' => 'FAMILIA',
            'measure_unit' => 'UNIDAD',
            'basic_classification_id' => 2,
        ]);
        Product::factory()->create([
            'name' => 'CLOROX ANTIHONGOS X 500 ML',
            'basic_client_id' => 8,
            'tax_percentage' => 19,
            'brand' => 'FULLER',
            'measure_unit' => 'UNIDAD',
            'basic_classification_id' => 2,
        ]);
        Product::factory()->create([
            'name' => 'DESINFECTANTE GALON X 4 LTS',
            'basic_client_id' => 8,
            'tax_percentage' => 19,
            'brand' => 'FULLER',
            'measure_unit' => 'GALON',
            'basic_classification_id' => 2,
        ]);
        Product::factory()->create([
            'name' => 'ESCOBA',
            'basic_client_id' => 8,
            'tax_percentage' => 19,
            'brand' => 'OB',
            'measure_unit' => 'UNIDAD',
            'basic_classification_id' => 2,
        ]);
        Product::factory()->create([
            'name' => 'TOALLAS DE MANO DOBLADAS X150X24',
            'basic_client_id' => 8,
            'tax_percentage' => 19,
            'brand' => 'TIZU',
            'measure_unit' => 'CAJAX24',
            'basic_classification_id' => 2,
        ]);
        Product::factory()->create([
            'name' => 'TOALLAS MANO FLIA PRECOR NAT UNIDAD',
            'basic_client_id' => 8,
            'tax_percentage' => 19,
            'brand' => 'FAMILIA',
            'measure_unit' => 'UNIDAD',
            'basic_classification_id' => 2,
        ]);
        Product::factory()->create([
            'name' => 'AROMATICA DE CIDRON X 20 UND',
            'basic_client_id' => 8,
            'tax_percentage' => 19,
            'brand' => 'INDU',
            'measure_unit' => 'CAJAX20',
            'basic_classification_id' => 2,
        ]);
        Product::factory()->create([
            'name' => 'INSTACREM CAJA X 100 SOBRES',
            'basic_client_id' => 8,
            'tax_percentage' => 19,
            'brand' => 'INSTACREM',
            'measure_unit' => 'CAJAX100',
            'basic_classification_id' => 2,
        ]);
        Product::factory()->create([
            'name' => 'PLATO DESECHABLE 20CM X 20UND',
            'basic_client_id' => 8,
            'tax_percentage' => 19,
            'brand' => 'DARNELL',
            'measure_unit' => 'PQTX20',
            'basic_classification_id' => 2,
        ]);
    }
}
