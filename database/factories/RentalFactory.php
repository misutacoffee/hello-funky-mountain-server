<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_uuid' => User::inRandomOrder()->first()->uuid,
            'contract_uuid' => Contract::inRandomOrder()->first()->uuid,
            'rental_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'return_date' => fake()->dateTimeBetween('now', '+1 year'),
            'description' => fake()->paragraph(),
            'note' => fake()->paragraph(),
            'uuid' => Str::uuid(),
        ];
    }
}
