<?php
namespace Modules\Orders\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Modules\Basics\Entities\Classification;
use Modules\Basics\Entities\Client;
use Modules\Basics\Entities\Employee;
use Modules\Basics\Entities\Payment;
use Modules\Orders\Entities\TypePrice;

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
            'basic_client_id' => $client = $this->faker->numberBetween(93, 95),
            'basic_client_name' => Client::whereId($client)->first()->client_name,
            'basic_payment_id' => $payment = $this->faker->numberBetween(1, 6),
            'basic_payment_name' => Payment::whereId($payment)->first()->name,
            'observation' => $this->faker->text(200),
			'order_type_price_id' => $typeprice = $this->faker->numberBetween(21, 24),
			'order_type_price_name' => TypePrice::whereId($typeprice)->first()->name,
            'biller' => 56054319,
            'responsible' => 7383633,
            'basic_classification_id' => $classification = $this->faker->numberBetween(1, 4),
            'basic_classification_name' => Classification::whereId($classification)->first()->name, 
			'brute' => 0,
			'discount' => 0,
			'subtotal' => 0,
			'tax_sale' => 0,
			'total' => 0,
        ];
    }
}

