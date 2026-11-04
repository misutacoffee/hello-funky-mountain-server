<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'show'])->middleware('auth:sanctum');
Route::resource('/contracts', ContractController::class)->middleware('auth:sanctum');
Route::resource('/equipment', EquipmentController::class)->middleware('auth:sanctum');
Route::resource('/invoices', InvoiceController::class)->middleware('auth:sanctum');
Route::resource('/manufacturers', ManufacturerController::class)->middleware('auth:sanctum');
Route::resource('/messages', MessageController::class)->middleware('auth:sanctum');
Route::resource('/models', ManufacturerModelController::class)->middleware('auth:sanctum');
Route::resource('/notifications', NotificationController::class)->middleware('auth:sanctum');
Route::resource('/rentals', RentalController::class)->middleware('auth:sanctum');
Route::get('/manufacturers/{uuid}/models', [ManufacturerModelController::class, 'indexByManufacturer'])->middleware('auth:sanctum');
Route::get('/manufacturers/{uuid}/models/create', [ManufacturerModelController::class, 'createByManufacturer'])->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
Route::get('/authenticated-test-request', [DevController::class, 'authenticatedTestRequest'])->middleware('auth:sanctum');
Route::get('/unauthenticated-test-request', [DevController::class, 'unauthenticatedTestRequest']);
Route::get('/contracts/{uuid}/rentals', [RentalController::class, 'indexByContract']);
