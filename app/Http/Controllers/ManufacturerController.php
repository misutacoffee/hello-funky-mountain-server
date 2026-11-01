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
        $manufacturers = Manufacturer::orderBy('name')->get();
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
        $request->validate([
            'name' => [
                'required', 
                'string', 
                // Rule::unique('manufacturers', 'name')->where(function ($query) use ($request) {
                //     return $query->whereRaw('LOWER(name) = ?', [strtolower($request->name)]);
                // }),
            ],
            'description' => 'nullable|string|max:1000',
            'note' => 'nullable|string|max:1000',
            // 'website' => 'nullable|url|max:255', 
            'is_active' => 'required|boolean', 
            'uuid' => 'required|uuid',
        ]);
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
