<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Contract;
use App\Models\Rental;
use App\Models\User;
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
        $subtotal = fake()->randomFloat(2, 1, 99999999);
        $tax = round($subtotal * 0.08, 2);
        $total = round($subtotal + $tax, 2);
        return [
            'title' => fake()->words(3, true), 
            'contract_uuid' => Contract::inRandomOrder()->first()->uuid, 
            'rental_uuid' => Rental::inRandomOrder()->first()->uuid, 
            'purchase_order_number' => null, 
            'sub_total' => $subtotal, 
            'tax' => $tax, 
            'total' => $total, 
            'status' => null, 
            'invoice_date' => fake()->dateTimeBetween('-1 year', 'now'), 
            'due_date' => fake()->dateTimeBetween('-1 year', 'now'), 
            'paid_date' => fake()->dateTimeBetween('-1 year', 'now'), 
            'user_uuid' => User::inRandomOrder()->first()->uuid,
            'uuid' => Str::uuid(), 
        ];
    }
}
