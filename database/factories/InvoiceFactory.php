<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
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
            'amount' => fake()->randomNumber(10),
            'tax' => fake()->randomNumber(10),
            'invoice_date' => fake()->date(),
            'due_date' => fake()->date(),
            'paid_date' => fake()->date(),
            'status' => fake()->word(),
            'description' => fake()->paragraph(),
            'note' => fake()->paragraph(),
            'is_active' => true,
            'uuid' => \Illuminate\Support\Str::uuid(),
        ];
    }
}
