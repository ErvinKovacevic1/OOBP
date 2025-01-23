<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RadniciController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('radnici', RadniciController::class);
Route::get('radnici', [RadniciController::class, 'index']);
Route::post('radnici', [RadniciController::class, 'store']);
Route::put('radnici/{id}', [RadniciController::class, 'update']);
Route::put('radnici/{id}', [RadniciController::class, 'update']);
Route::put('radnici/{id}', [RadniciController::class, 'update']);
