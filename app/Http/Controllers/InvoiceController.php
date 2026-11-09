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
    public function index(Request $request)
    {
        $user = $request->user();
        $invoices = Invoice::where('user_uuid', $user->uuid)->with('contract', 'rental')->get();
        return response()->json(compact('invoices'));
    }

    public function indexByContract(Request $request, $contractUuid)
    {
        $contract = Contract::where('uuid', $contractUuid)->firstOrFail();
        $invoices = Invoice::where('contract_uuid', $contractUuid)->with('contract', 'rental')->get();
        return response()->json(compact('contract', 'invoices'));
    }

    public function indexByRental(Request $request, $rentalUuid)
    {
        $rental = Rental::where('uuid', $rentalUuid)->firstOrFail();
        $invoices = Invoice::where('rental_uuid', $rentalUuid)->with('contract', 'rental')->get();
        return response()->json(compact('rental', 'invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = $request->user();
        $contracts = Contract::where('user_uuid', $user->uuid)->get();
        $rentals = Rental::where('user_uuid', $user->uuid)->get();
        return response()->json(compact('contracts', 'rentals'));
    }

    public function createByContract(Request $request, string $contractUuid)
    {
        $user = $request->user();
        $contracts = Contract::where('user_uuid', $user->uuid)->get();
        $rentals = Rental::where('user_uuid', $user->uuid)->get();
        $contract = Contract::where('uuid', $contractUuid)->firstOrFail();
        return response()->json(compact('contract', 'contracts', 'rentals'));
    }

    public function createByRental(Request $request, string $rentalUuid)
    {
        $user = $request->user();
        $contracts = Contract::where('user_uuid', $user->uuid)->get();
        $rentals = Rental::where('user_uuid', $user->uuid)->get();
        $rental = Rental::where('uuid', $rentalUuid)->firstOrFail();
        $contract = Contract::where('uuid', $rental->contract_uuid)->first();
        return response()->json(compact('rental', 'contract', 'contracts', 'rentals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string', 
            'purchase_order_number' => 'nullable|string', 
            'invoice_date' => 'nullable|string', 
            'sub_total' => 'nullable|string', 
            'tax' => 'nullable|string', 
            'total' => 'nullable|string', 
            'status' => 'nullable|string', 
            'due_date' => 'nullable|string', 
            'paid_date' => 'nullable|string', 
            'rental_uuid' => 'nullable|uuid', 
            'contract_uuid' => 'required|uuid', 
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
        $invoice = Invoice::where('uuid', $uuid)->with('contract', 'rental')->first();
        return response()->json($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $uuid)
    {
        $user = $request->user();
        $invoice = Invoice::where('uuid', $uuid)->firstOrFail();
        $contract = $invoice->contract_uuid ? Contract::where('uuid', $invoice->contract_uuid)->first() : null;
        $rental = $invoice->rental_uuid ? Rental::where('uuid', $invoice->rental_uuid)->first() : null;
        $contracts = Contract::where('user_uuid', $user->uuid)->get();
        $rentals = Rental::where('user_uuid', $user->uuid)->get();
        return response()->json(compact('invoice', 'contract', 'rental', 'contracts', 'rentals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $request->validate([
            'title' => 'nullable|string', 
            'purchase_order_number' => 'nullable|string', 
            'invoice_date' => 'nullable|string', 
            'sub_total' => 'nullable|string', 
            'tax' => 'nullable|string', 
            'total' => 'nullable|string', 
            'status' => 'nullable|string', 
            'due_date' => 'nullable|string', 
            'paid_date' => 'nullable|string', 
            'rental_uuid' => 'nullable|uuid', 
            'contract_uuid' => 'required|uuid', 
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
        Invoice::where('uuid', $uuid)->delete();
        return response()->json(['success' => true, 'message' => "This invoice has been deleted from the database."]);
    }
}
