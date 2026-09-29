<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class ContractUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'description' => fake()->paragraph(),
            'note' => fake()->paragraph(),
            'is_active' => true,
            'contract_uuid' => Contract::inRandomOrder()->first()->uuid,
            'uuid' => \Illuminate\Support\Str::uuid(),
        ];
    }
}
