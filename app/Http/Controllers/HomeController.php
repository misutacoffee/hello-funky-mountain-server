<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Equipment;
use App\Models\Invoice;
use App\Models\Manufacturer;
use App\Models\ManufacturerModel;
use App\Models\Rental;
use App\Models\User;

class HomeController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        $contracts = Contract::where('user_uuid', $user->uuid)->get();
        $equipment = Equipment::where('user_uuid', $user->uuid)->get();
        $manufacturers = Manufacturer::get();
        $manufacturerModels = ManufacturerModel::get();
        $invoices = Invoice::where('user_uuid', $user->uuid)->get();
        $rentals = Rental::where('user_uuid', $user->uuid)->get();
        $users = User::get();
        $homeData = [
            'contracts' => $contracts,
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
