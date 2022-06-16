<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'identification' => $this->faker->numberBetween(1000000, 2000000),
			// 'first_name' => $this->faker->name,
			// 'last_name' => $this->faker->name,			
        ];
    }

    public function forUser(User $user)
    {
        return $this->state(function () use ($user) {
            return [
                'user_id' => $user->getKey(),
            ];
        });
    }

    public function withBio(string $bio)
    {
        return $this->state(function () use ($bio) {
            return [
                'bio' => $bio,
            ];
        });
    }

    public function withIdentification(string $identification)
    {
        return $this->state(function () use ($identification) {
            return [
                'identification' => $identification,
            ];
        });
    }
}
