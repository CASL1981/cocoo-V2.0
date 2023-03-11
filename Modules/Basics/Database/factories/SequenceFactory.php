<?php
namespace Modules\Basics\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SequenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Basics\Entities\Sequence::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'document' => $this->faker->randomElement(['OC', 'OS']),
            'document_name' => $this->faker->name(),
            'number' => 10,
        ];
    }
}

