<?php
namespace Modules\Basics\Database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Basics\Entities\Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'identification' => $this->faker->numberBetween(1000000, 2000000),
			'first_name' => $this->faker->name,
			'last_name' => $this->faker->name,			
			'client_name' => $this->faker->name,			
            'status' => true,
            'type_document' => 'CC',
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'cel_phone' => $this->faker->phoneNumber,
			'entry_date' => Carbon::now(),
            'email' => $this->faker->unique()->safeEmail(),
			'gender' => $this->faker->randomElement(['M', 'F']),
			'type' => 'Otro',
			'birth_date' => Carbon::now(),			
			'limit' => 1000000,
			'vendedor_id' => 1,
			'typeprice_id' => $this->faker->numberBetween(1, 20),
			'shoppingcontact' => 'Rango',
			'conditionpayment_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}

