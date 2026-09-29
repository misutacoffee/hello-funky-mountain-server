<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\ContractUser;
use App\Models\Equipment;
use App\Models\Invoice;
use App\Models\Manufacturer;
use App\Models\ManufacturerModel;
use App\Models\Rental;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Manufacturer::factory(10)->create();
        ManufacturerModel::factory(10)->create();
        Contract::factory(10)->create();
        ContractUser::factory(10)->create();
        // Equipment::factory(10)->create();
        // Rental::factory(10)->create();
        // Invoice::factory(10)->create();
        // Service::factory(10)->create();
    }
}
