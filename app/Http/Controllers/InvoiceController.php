<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Invoice;
use App\Models\Rental;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['success' => true]);
    }

    public function createByContract(string $contractUuid)
    {
        $contract = Contract::where('uuis', $contractUuid)->firstOrFail();
        return response()->json(compact('contract'));
    }

    public function createByRental(string $rentalUuid)
    {
        $rental = Rental::where('uuid', $rentalUuid)->firstOrFail();
        $contract = Contract::where('uuid', $rental->contract_uuid)->first();
        return response()->json(compact('rental', 'contract'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'purchase_order_number' => 'nullable|string', 
            'invoice_date' => 'nullable|string', 
            'amount' => 'nullable|string', 
            'tax' => 'nullable|string', 
            'status' => 'nullable|string', 
            'due_date' => 'nullable|string', 
            'paid_date' => 'nullable|string', 
            'rental_uuid' => 'nullable|uuid', 
            'contract_uuid' => 'nullable|uuid', 
            'user_uuid' => 'required|uuid', 
            'uuid' => 'required|uuid', 
        ]);
        $invoice = Invoice::create($request->all());
        return response()->json(['invoice' => $invoice, 'success' => true, 'message' => "Invoice successfully stored to the database."]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $invoice = Invoice::where('uuid', $uuid)->firstOrFail();
        $contract = $invoice->contract_uuid ? Contract::where('uuid', $invoice->contract_uuid)->first() : null;
        $rental = $invoice->rental_uuid ? Rental::where('uuid', $invoice->rental_uuid)->first() : null;
        return response()->json(compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $request->validate([
            'purchase_order_number' => 'nullable|string', 
            'invoice_date' => 'nullable|string', 
            'amount' => 'nullable|string', 
            'tax' => 'nullable|string', 
            'status' => 'nullable|string', 
            'due_date' => 'nullable|string', 
            'paid_date' => 'nullable|string', 
            'rental_uuid' => 'nullable|uuid', 
            'contract_uuid' => 'nullable|uuid', 
            'user_uuid' => 'required|uuid', 
            'uuid' => 'required|uuid', 
        ]);
        $invoice = Invoice::where('uuid', $uuid)->update($request->all());
        return response()->json(['invoice' => $invoice, 'success' => true, 'message' => "Invoice successfully updated to the database."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        //
    }
}
