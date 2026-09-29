<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\User;
use App\Models\ManufacturerModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Equipment>
 */
class EquipmentFactory extends Factory
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
            'serial_number' => Str::random(10),
            'is_active' => true,
            'user_uuid' => User::inRandomOrder()->first()->uuid,
            'manufacturer_model_uuid' => ManufacturerModel::inRandomOrder()->first()->uuid,
            'uuid' => Str::uuid(),
        ];
    }
}
