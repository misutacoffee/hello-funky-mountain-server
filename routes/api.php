<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ManufacturerModelController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RentalController;

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'show']);
    Route::resource('/contracts', ContractController::class);
    Route::resource('/equipment', EquipmentController::class);
    Route::resource('/invoices', InvoiceController::class);
    Route::resource('/manufacturers', ManufacturerController::class);
    Route::resource('/messages', MessageController::class);
    Route::resource('/models', ManufacturerModelController::class);
    Route::resource('/notifications', NotificationController::class);
    Route::resource('/rentals', RentalController::class);
    Route::get('/manufacturers/{uuid}/models', [ManufacturerModelController::class, 'indexByManufacturer']);
    Route::get('/manufacturers/{uuid}/models/create', [ManufacturerModelController::class, 'createByManufacturer']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/contracts/{uuid}/rentals', [RentalController::class, 'indexByContract']);
    Route::get('/contracts/{uuid}/invoices', [InvoiceController::class, 'indexByContract']);
    Route::get('/contracts/{uuid}/invoices/create', [InvoiceController::class, 'createByContract']);
    Route::get('/rentals/{uuid}/invoices', [InvoiceController::class, 'indexByRental']);
    Route::get('/rentals/{uuid}/invoices/create', [InvoiceController::class, 'createByRental']);
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-email', [AuthController::class, 'verifyEmail'])->middleware('auth:sanctum');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return response()->json(['success' => true, 'message' => "Email successfully verified."]);
})->middleware(['auth:sanctum'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json(['success' => true, 'message' => "Verification link sent."]);
})->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');
