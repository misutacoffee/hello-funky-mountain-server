<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manufacturers = Manufacturer::get();
        return response()->json($manufacturers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['success' => true]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string', 
            'note' => 'nullable|string', 
            'website' => 'nullable|string', 
            'is_active' => 'required|boolean', 
            'uuid' => 'required|uuid', 
        ]);
        $manufacturer = Manufacturer::create($request->all());
        return response()->json(['manufacturer' => $manufacturer, 'success' => true, 'message' => "Manufacturer successfully stored to the database."]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $manufacturer = Manufacturer::where('uuid', $uuid)->with('models')->first();
        return response()->json($manufacturer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $manufacturer = Manufacturer::where('uuid', $uuid)->first();
        return response()->json($manufacturer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string', 
            'note' => 'nullable|string', 
            'website' => 'nullable|string', 
            'is_active' => 'required|boolean', 
            'uuid' => 'required|uuid', 
        ]);
        $manufacturer = Manufacturer::where('uuid', $uuid)->update($request->all());
        return response()->json(['manufacturer' => $manufacturer, 'success' => true, 'message' => "Manufacturer successfully updated to the database."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        // authorize 
        // what about models? 
        // what about equipment marked as models with this manufacturer?
        Manufacturer::where('uuid', $uuid)->delete();
        return response()->json(['success' => true, 'message' => "This manufacturer has been deleted from the database."]);
    }
}
