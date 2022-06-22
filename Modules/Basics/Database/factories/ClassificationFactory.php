<?php
namespace Modules\Basics\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClassificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Basics\Entities\Classification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->randomElement(['1', '1100', '1200', '1300', '1400', '1500', '1600']),
            'level' => $this->faker->numberBetween(1, 3),
            'parent' => $this->faker->randomElement(['1', '1100', '1200', '1300', '1400']),
            'name' => $this->faker->name,            
			'impute' => $this->faker->randomElement([true, false]),
        ];
    }
}

