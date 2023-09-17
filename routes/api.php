<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\RecordController;

Route::get('vehicles', [VehicleController::class, 'index'])
    ->name('api.vehicles.index');

Route::get('vehicles/{vehicle}', [VehicleController::class, 'show'])
    ->name('api.vehicles.show');

Route::post('vehicles', [VehicleController::class, 'create'])
    ->name('api.vehicles.create');

Route::get('records', [RecordController::class, 'index'])
    ->name('api.records.index');

Route::get('records/pdf', [RecordController::class, 'createPDF'])
    ->name('api.record.createPDF');

Route::get('records/{record}', [RecordController::class, 'show'])
    ->name('api.record.show');

Route::post('records', [RecordController::class, 'create'])
    ->name('api.records.create');

Route::put('records', [RecordController::class, 'checkOut'])
    ->name('api.records.checkOut');




