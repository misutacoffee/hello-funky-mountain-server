<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Invoice;
use App\Models\Manufacturer;
use App\Models\ManufacturerModel;
use App\Models\Rental;
use App\Models\User;

class HomeController extends Controller
{
    public function show()
    {
        $equipment = Equipment::get();
        $manufacturers = Manufacturer::get();
        $manufacturerModels = ManufacturerModel::get();
        $invoices = Invoice::get();
        $rentals = Rental::get();
        $users = User::get();
        $homeData = [
            'equipment' => $equipment,
            'manufacturers' => $manufacturers,
            'manufacturerModels' => $manufacturerModels,
            'invoices' => $invoices,
            'rentals' => $rentals,
            'users' => $users,
        ];
        return response()->json($homeData);
    }
}
