<?php

use App\Http\Controllers\Api\TransportUnitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/transportUnits', TransportUnitController::class);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
