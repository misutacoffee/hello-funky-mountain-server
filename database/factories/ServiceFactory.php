<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->paragraph(),
            'note' => fake()->paragraph(),
            'is_active' => true,
            'user_uuid' => User::inRandomOrder()->first()->uuid,
            'uuid' => \Illuminate\Support\Str::uuid(),
        ];
    }
}
