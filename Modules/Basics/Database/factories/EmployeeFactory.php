<?php
namespace Modules\Basics\Database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Basics\Entities\Employee::class;

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
            'status' => true,
            'type_document' => 'CC',
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'cel_phone' => $this->faker->phoneNumber,
			'entry_date' => Carbon::now(),
            'email' => $this->faker->unique()->safeEmail(),
			'gender' => $this->faker->randomElement(['M', 'F']),
			'birth_date' => Carbon::now(),			
			'location_id' => $this->faker->randomElement(['1', '1100', '1200', '1300', '1400', '1500', '1600']),
			'photo_path' => '',
        ];
    }
}

