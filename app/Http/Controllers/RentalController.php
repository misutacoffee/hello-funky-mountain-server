<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Equipment;
use App\Models\Invoice;
use App\Models\Rental;
use App\Models\RentalEquipment;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $rentals = Rental::where('user_uuid', $user->uuid)->with('contract')->get();
        return response()->json(compact('rentals'));
    }

    public function indexByContract(Request $request, string $uuid)
    {
        $contract = Contract::where('uuid', $uuid)->first();
        $rentals = Rental::where('contract_uuid', $uuid)->get();
        return response()->json(compact('contract', 'rentals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = $request->user();
        $contracts = Contract::where('user_uuid', $user->uuid)->get();
        $equipment = Equipment::where('user_uuid', $user->uuid)->with('model', 'manufacturer')->get();
        return response()->json(compact('contracts', 'equipment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rental_date' => 'nullable|string', 
            'return_date' => 'nullable|string', 
            'description' => 'nullable|string', 
            'note' => 'nullable|string', 
            'contract_uuid' => 'required|uuid', 
            'user_uuid' => 'required|uuid', 
            'uuid' => 'required|uuid', 
            'rental_equipment.*.rental_uuid' => 'required|uuid', // can also verify against the rental uuid
            'rental_equipment.*.equipment_uuid' => 'required|uuid', 
            'rental_equipment.*.quantity' => 'nullable|string', 
            'rental_equipment.*.unit' => 'nullable|string', 
            'rental_equipment.*.price' => 'nullable|decimal', 
            'rental_equipment.*.total' => 'nullable|decimal',
            'rental_equipment.*.note' => 'nullable|string', 
            'rental_equipment.*.uuid' => 'required|uuid',  
        ]);
        $rental = Rental::create($request->except('rental_equipment'));
        foreach($request['rental_equipment'] as $rentalEquipment){
            RentalEquipment::create($rentalEquipment);
        }
        $rental->with('contract', 'rentalEquipment');
        return response()->json(['rental' => $rental, 'success' => true, 'message' => "Rental successfully stored to the database."]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $uuid)
    {
        $user = $request->user();
        $equipment = Equipment::where('user_uuid', $user->uuid)->with('model')->get(); // needed?
        $invoices = Invoice::where('rental_uuid', $uuid)->get();
        $rental = Rental::where('uuid', $uuid)->with(['contract', 'rentalEquipment' => ['equipment']])->first();
        return response()->json(compact('equipment', 'invoices', 'rental'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $uuid)
    {
        $user = $request->user();
        $contracts = Contract::where('user_uuid', $user->uuid)->get();
        $equipment = Equipment::where('user_uuid', $user->uuid)->with('model', 'manufacturer')->get();
        $rental = Rental::where('uuid', $uuid)->with('contract', 'rentalEquipment')->first();
        $rentalEquipment = RentalEquipment::where('rental_uuid', $uuid)->get();
        $contract = Contract::where('uuid', $rental->contract_uuid)->first();
        return response()->json(compact('contracts', 'equipment', 'rental', 'rentalEquipment', 'contract'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $request->validate([
            'rental_date' => 'nullable|string', 
            'return_date' => 'nullable|string', 
            'description' => 'nullable|string', 
            'note' => 'nullable|string', 
            'contract_uuid' => 'required|uuid', 
            'user_uuid' => 'required|uuid', 
            'uuid' => 'required|uuid', 
            'rental_equipment.*.rental_uuid' => 'required|uuid', // can also verify against the rental uuid
            'rental_equipment.*.equipment_uuid' => 'required|uuid', 
            'rental_equipment.*.quantity' => 'nullable|string', 
            'rental_equipment.*.unit' => 'nullable|string', 
            'rental_equipment.*.price' => 'nullable|decimal', 
            'rental_equipment.*.total' => 'nullable|decimal',
            'rental_equipment.*.note' => 'nullable|string', 
            'rental_equipment.*.uuid' => 'required|uuid',  
        ]);
        $rental = Rental::where('uuid', $uuid)->update($request->except('rental_equipment'));
        $equipmentUuids = collect($request['rental_equipment'] || [])->pluck('equipment_uuid');
        RentalEquipment::where('rental_uuid', $uuid)->whereNotIn('equipment_uuid', $equipmentUuids)->delete();
        foreach($request['rental_equipment'] as $rentalEquipment){
            RentalEquipment::updateOrCreate(['uuid' => $rentalEquipment['uuid']], $rentalEquipment);
        }
        return response()->json(['rental' => $rental, 'success' => true, 'message' => "Rental successfully updated to the database."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        Rental::where('uuid', $uuid)->delete();
        return response()->json(['success' => true, 'message' => "This rental has been deleted from the database."]);
    }
}
