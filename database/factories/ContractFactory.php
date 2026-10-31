<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'display_name' => fake()->companySuffix(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'primary_address' => fake()->streetAddress(),
            'secondary_address' => fake()->optional(0.25)->secondaryAddress(),
            'tertiary_address' => fake()->optional(0.05)->buildingNumber(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
            'zip' => fake()->postcode(),
            'description' => fake()->optional(0.16)->paragraph(),
            'note' => fake()->optional(0.08)->paragraph(),
            'is_active' => true,
            'user_uuid' => User::inRandomOrder()->first()->uuid,
            'uuid' => \Illuminate\Support\Str::uuid(),
        ];
    }
}
