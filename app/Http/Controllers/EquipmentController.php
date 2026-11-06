<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipment;
use App\Models\Manufacturer;
use App\Models\ManufacturerModel;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $equipment = Equipment::where('user_uuid', Auth::user()->uuid)->with(['model' => ['manufacturer']])->get();
        }else{
            $equipment = Equipment::with(['model' => ['manufacturer']])->get();
        }
        return response()->json(compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = $request->user();
        $manufacturers = Manufacturer::get();
        $models = ManufacturerModel::get();
        return response()->json(['user' => $user, 'manufacturers' => $manufacturers, 'models' => $models]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'rental_rate' => 'nullable|numeric',
            'rental_unit' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'user_uuid' => 'required|uuid',
            'manufacturer_model_uuid' => 'required|uuid',
            'uuid' => 'required|uuid',
        ]);
        $equipment = Equipment::create($request->all());
        return response()->json(['equipment' => $equipment, 'success' => true, 'message' => "Equipment successfully stored to the database."]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $equipment = Equipment::with('model', 'manufacturer')->where('uuid', $uuid)->first();
        if (!$equipment) {
            return response()->json(['message' => 'Equipment not found'], 404);
        }
        return response()->json($equipment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $uuid)
    {
        $user = $request->user();
        $equipment = Equipment::where('uuid', $uuid)->with('manufacturer', 'model')->first();
        $manufacturers = Manufacturer::get();
        $models = ManufacturerModel::get();
        return response()->json(['equipment' => $equipment, 'user' => $user, 'manufacturers' => $manufacturers, 'models' => $models]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'rental_rate' => 'nullable|numeric',
            'rental_unit' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'user_uuid' => 'required|uuid',
            'manufacturer_model_uuid' => 'required|uuid',
            'uuid' => 'required|uuid',
        ]);
        $equipment = Equipment::where('uuid', $uuid)->update($request->all());
        return response()->json(['equipment' => $equipment, 'success' => true, 'message' => "Equipment successfully updated to the database."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        Equipment::where('uuid', $uuid)->delete();
        return response()->json(['success' => true, 'message' => "Equipment successfully deleted from the database."]);
    }
}
