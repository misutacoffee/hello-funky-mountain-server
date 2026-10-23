<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class ManufacturerModelFactory extends Factory
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
            'type' => fake()->words(2, true), 
            'description' => fake()->paragraph(),
            'note' => fake()->paragraph(),
            'is_active' => true,
            'manufacturer_uuid' => Manufacturer::inRandomOrder()->first()->uuid,
            'uuid' => \Illuminate\Support\Str::uuid(),
        ];
    }
}
