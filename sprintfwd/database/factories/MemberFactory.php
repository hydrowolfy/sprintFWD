<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'created_at' => now(),
            'updated_at' => now(),
            'team_id' => $this->faker->unique()->randomNumber()
        ];
    }
}
