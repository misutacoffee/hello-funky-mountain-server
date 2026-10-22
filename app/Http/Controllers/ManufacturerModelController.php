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
        $manufacturerModels = ManufacturerModel::get();
        return response()->json($manufacturerModels);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexByManufacturer(string $manufacturerUuid)
    {
        $manufacturer = Manufacturer::where('uuid', $manufacturerUuid)->with('manufacturerModels')->first();
        return response()->json($manufacturer);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        //
    }
}
