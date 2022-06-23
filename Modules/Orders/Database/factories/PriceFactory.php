<?php
namespace Modules\Orders\Database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Orders\Entities\Price::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_product_id' => $this->faker->numberBetween(41, 49),
            'basic_client_id' => $this->faker->numberBetween(93, 95),
			'order_type_price_id' => $this->faker->numberBetween(21, 24),
            'date' => Carbon::now()->addWeek(2),			
            'value' => $this->faker->randomNumber(4,true)
        ];
    }
}

