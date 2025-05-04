<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoogleTokenFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first()?->id ?? User::factory(),
            'access_token' => $this->faker->text(255),
            'refresh_token' => $this->faker->optional()->text(255),
            'expires_at' => $this->faker->optional()->dateTime(),
        ];
    }
}
