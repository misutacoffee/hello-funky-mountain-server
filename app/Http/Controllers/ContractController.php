<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $contracts = Contract::where('user_uuid', $user->uuid)->get();
        return response()->json($contracts);
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
            'display_name' => 'nullable|string', 
            'phone' => 'nullable|string', 
            'email' => 'nullable|string', 
            'primary_address' => 'nullable|string', 
            'secondary_address' => 'nullable|string', 
            'tertiary_address' => 'nullable|string', 
            'city' => 'nullable|string', 
            'state' => 'nullable|string', 
            'zip' => 'nullable|string', 
            'description' => 'nullable|string', 
            'note' => 'nullable|string', 
            'is_active' => 'required|boolean', 
            'user_uuid' => 'required|uuid', 
            'uuid' => 'required|uuid', 
        ]);
        $contract = Contract::create($request->all());
        return response()->json(['contract' => $contract, 'success' => true, 'message' => "Contract successfully stored to the database."]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $contract = Contract::where('uuid', $uuid)->first();
        return response()->json($contract);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $contract = Contract::where('uuid', $uuid)->first();
        return response()->json($contract);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $request->validate([
            'name' => 'required|string', 
            'display_name' => 'nullable|string', 
            'phone' => 'nullable|string', 
            'email' => 'nullable|string', 
            'primary_address' => 'nullable|string', 
            'secondary_address' => 'nullable|string', 
            'tertiary_address' => 'nullable|string', 
            'city' => 'nullable|string', 
            'state' => 'nullable|string', 
            'zip' => 'nullable|string', 
            'description' => 'nullable|string', 
            'note' => 'nullable|string', 
            'is_active' => 'required|boolean', 
            'user_uuid' => 'required|uuid', 
            'uuid' => 'required|uuid', 
        ]);
        $contract = Contract::where('uuid', $uuid)->update($request->all());
        return response()->json(['contract' => $contract, 'success' => true, 'message' => "Contract successfully updated to the database."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        Contract::where('uuid', $uuid)->delete();
        return response()->json(['success' => true, 'message' => "Contract successfully deleted from the database."]);
    }
}
