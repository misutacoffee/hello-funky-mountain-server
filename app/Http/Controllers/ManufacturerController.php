<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $manufacturer = Manufacturer::where('uuid', $uuid)->with('manufacturerModels')->first();
        return response()->json($manufacturer);
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
        // validate
        $manufacturer = $request->all();
        Manufacturer::updateOrCreate(['uuid' => $uuid], $manufacturer);
        return response()->json(['success' => true, 'message' => "This manufacturer has been successfully saved to the database."]);
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
