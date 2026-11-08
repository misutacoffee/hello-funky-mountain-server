<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Models\ManufacturerModel;

class ManufacturerModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = ManufacturerModel::with('manufacturer')->get();
        return response()->json(compact('models'));
    }

    /**
     * Display a listing of the resource.
     */
    public function indexByManufacturer(string $manufacturerUuid)
    {
        $manufacturer = Manufacturer::where('uuid', $manufacturerUuid)->firstOrFail();
        $models = ManufacturerModel::where('manufacturer_uuid', $manufacturerUuid)->with('manufacturer')->get();
        return response()->json(compact('manufacturer', 'models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $manufacturers = Manufacturer::get();
        return response()->json(compact('manufacturers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createByManufacturer(string $manufacturerUuid)
    {
        $manufacturer = Manufacturer::where('uuid', $manufacturerUuid)->with('manufacturerModels')->first();
        return response()->json($manufacturer);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'nullable|string',  
            'description' => 'nullable|string',  
            'note' => 'nullable|string',  
            'is_active' => 'required|boolean', 
            'manufacturer_uuid' => 'required|uuid', 
            'uuid' => 'required|uuid', 
        ]);
        $model = ManufacturerModel::create($request->all());
        return response()->json(['model' => $model, 'success' => true, 'message' => "Model successfully stored to the database."]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $model = ManufacturerModel::where('uuid', $uuid)->with('manufacturer')->first();
        return response()->json($model);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $manufacturers = Manufacturer::get();
        $model = ManufacturerModel::where('uuid', $uuid)->with('manufacturer')->first();
        return response()->json(compact('manufacturers', 'model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'nullable|string',  
            'description' => 'nullable|string',  
            'note' => 'nullable|string',  
            'is_active' => 'required|boolean', 
            'manufacturer_uuid' => 'required|uuid', 
            'uuid' => 'required|uuid', 
        ]);
        $model = ManufacturerModel::where('uuid', $uuid)->update($request->all());
        return response()->json(['model' => $model, 'success' => true, 'message' => "Model successfully updated to the database."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        ManufacturerModel::where('uuid', $uuid)->delete();
        return response()->json(['success' => true, 'message' => "Manufacturer successfully deleted from the database."]);
    }
}
