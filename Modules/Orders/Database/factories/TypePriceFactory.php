<?php
namespace Modules\Orders\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypePriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Orders\Entities\TypePrice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
			'increment' => $this->faker->numberBetween(1, 100),
			'tax' => true,
            'type' => $this->faker->randomElement(['FIJO', 'VARIABLE']),
			'minimum' => $this->faker->numberBetween(1, 100),
			'maximum' => $this->faker->numberBetween(1, 100),            
        ];
    }
}

