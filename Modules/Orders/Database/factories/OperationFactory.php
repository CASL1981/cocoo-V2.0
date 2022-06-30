<?php
namespace Modules\Orders\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Modules\Basics\Entities\Employee;

class OperationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Orders\Entities\Operation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => Carbon::now(),
            'basic_client_id' => $this->faker->numberBetween(93, 95),
            'basic_payment_id' => $this->faker->numberBetween(1, 6),
            'observation' => $this->faker->text(200),
			'order_type_price_id' => $this->faker->numberBetween(21, 24),
            'biller' => 56054319,
            'responsible' => 7383633,
            'basic_classification_id' => $this->faker->numberBetween(1, 4),
			'brute' => 0,
			'discount' => 0,
			'subtotal' => 0,
			'tax_sale' => 0,
			'total' => 0,
        ];
    }
}

