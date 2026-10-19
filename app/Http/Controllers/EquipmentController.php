<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment = Equipment::with(['manufacturerModel' => ['manufacturer']])->get();
        return response()->json($equipment);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function edit(string $uuid)
    {
        //
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
