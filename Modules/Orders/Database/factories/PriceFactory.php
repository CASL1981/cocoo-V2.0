<?php
namespace Modules\Orders\Database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Orders\Entities\Product;

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
            'order_product_id' => $product = $this->faker->numberBetween(41, 49),
            'order_product_name' => Product::whereId($product)->first()->name,
            'basic_client_id' => $this->faker->numberBetween(93, 95),
			'basic_type_price_id' => $this->faker->numberBetween(21, 24),
            'date' => Carbon::now()->addWeek(2),
            'value' => $this->faker->randomNumber(4,true)
        ];
    }
}

