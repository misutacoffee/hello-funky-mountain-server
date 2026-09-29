<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Rental;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Model>
 */
class RentalInvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = fake()->randomFloat(2);
        $tax = $amount * 0.08;
        return [
            'rental_uuid' => Rental::inRandomOrder()->first()->uuid, 
            'purchase_order_number' => null, 
            'amount' => $amount, 
            'tax' => $tax, 
            'status' => null, 
            'invoice_date' => fake()->dateTimeBetween('-1 year', 'now'), 
            'due_date' => fake()->dateTimeBetween('-1 year', 'now'), 
            'paid_date' => fake()->dateTimeBetween('-1 year', 'now'), 
            'uuid' => Str::uuid(), 
        ];
    }
}
