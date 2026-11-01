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
            $equipment = Equipment::where('user_uuid', Auth::user()->uuid)->with(['manufacturerModel' => ['manufacturer']])->get();
        }else{
            $equipment = Equipment::with(['manufacturerModel' => ['manufacturer']])->get();
        }
        return response()->json($equipment);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $equipment = Equipment::with(['manufacturerModel' => ['manufacturer']])->where('uuid', $uuid)->first();
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
        $equipment = Equipment::where('uuid', $uuid)->first();
        $manufacturers = Manufacturer::get();
        $models = ManufacturerModel::get();
        return response()->json(['equipment' => $equipment, 'user' => $user, 'manufacturers' => $manufacturers, 'models' => $models]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        // validation
        $equipment = $request->all();
        Equipment::updateOrCreate($equipment, ['uuid' => $uuid]);
        return response()->json(['success' => true, 'message' => "Equipment successfully saved to the database."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        //
    }
}
