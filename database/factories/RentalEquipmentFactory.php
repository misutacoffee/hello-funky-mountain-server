<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Rental;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class RentalEquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rental_uuid' => Rental::inRandomOrder()->first()->uuid,
            'equipment_uuid' => Equipment::inRandomOrder()->first()->uuid,
            'quantity' => fake()->randomNumber(2),
            'unit' => 'hour', 
            'price' => fake()->randomFloat(2, 10, 1000),
            'total' => fake()->randomFloat(2, 100, 10000),
            'uuid' => \Illuminate\Support\Str::uuid(),
        ];
    }
}
