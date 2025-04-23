<?php

namespace Database\Factories;

use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Opportunity>
 */
class OpportunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first()?->id ?? User::factory(),
            'name' => fake()->jobTitle(),
            'company' => fake()->company(),
            'companyLogo' => 'https://picsum.photos/200',
            'url' => fake()->url(),
            'description' => fake()->text(),
            'date' => fake()->date(),
            'status' => fake()->randomElement(Opportunity::STATUSES)['name'],
            'position' => 0,
        ];
    }
}
