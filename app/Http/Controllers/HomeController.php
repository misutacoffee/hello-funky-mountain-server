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
        $contracts = Contract::where('user_uuid', $user->uuid)->orderBy('name')->get();
        $equipment = Equipment::where('user_uuid', $user->uuid)->orderBy('name')->get();
        $manufacturers = Manufacturer::orderBy('name')->get();
        $manufacturerModels = ManufacturerModel::orderBy('name')->get();
        $invoices = Invoice::where('user_uuid', $user->uuid)->get();
        $rentals = Rental::where('user_uuid', $user->uuid)->get();
        $users = User::orderBy('name')->get();
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
