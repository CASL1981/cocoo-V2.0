<?php
namespace Modules\Orders\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Orders\Entities\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [            
			'name' => $this->faker->name,
			'tax' => true,
            'status' => true,
            'basic_client_id' => $this->faker->numberBetween(1, 5),
			'tax_percentage' => $this->faker->randomElement([19, 5]),
            'brand' => $this->faker->randomElement(['PAPER MATE', 'NORMA', 'FABER CASTELL', 'OTRO']),
            'measure_unit' => $this->faker->randomElement(['UNIDAD', 'CJA X 100', 'ROLLO', 'OTRO']),
            'basic_classification_id' => $this->faker->numberBetween(1, 4),
            'image' => '',            
        ];
    }
}

