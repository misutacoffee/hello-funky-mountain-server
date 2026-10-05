<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ManufacturerModelController;
use App\Http\Controllers\RentalController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::resource('/contracts', ContractController::class);
Route::resource('/equipment', EquipmentController::class);
Route::resource('/invoices', InvoiceController::class);
Route::resource('/manufacturers', ManufacturerController::class);
Route::resource('/manufacturer-models', ManufacturerModelController::class);
Route::resource('/rentals', RentalController::class);
