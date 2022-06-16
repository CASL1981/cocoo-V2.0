<?php
namespace Modules\Basics\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Basics\Entities\Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'quotas' => $this->faker->numberBetween(0, 5),
			'typeinterval' => $this->faker->randomElement(['D', 'S', 'M']),
            'interval' => $this->faker->numberBetween(0, 15),
        ];
    }
}

