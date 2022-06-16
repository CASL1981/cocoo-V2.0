<?php
namespace Modules\Basics\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Basics\Entities\Destination::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'costcenter' => $this->faker->randomElement(['1', '1100', '1200', '1300', '1400', '1500', '1600']),
            'name' => $this->faker->randomElement(['OFICINA PRINCIPAL', 'FARMACIA VALENCI', 'FARMACIA LORICA', 'FARMACIA MONTELIBANO', 'FARMACIA MONTERIA', 'FARMACIA PLANETA', 'FARMACIA SAN ANTERO']),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'location' => $this->faker->randomElement(['1', '1100', '1200', '1300', '1400', '1500', '1600']),
            'minimun' => 1,
            'maximun' => 10
        ];
    }
}

