<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CombomealController;
use App\Http\Controllers\BurgerController;
use App\Http\Controllers\BeverageController;
use App\Http\Controllers\OrderController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/combomeals', [CombomealController::class, 'index']);
Route::get('/burgers', [BurgerController::class, 'index']);
Route::get('/beverages', [BeverageController::class, 'index']);
Route::post('/createOrder', [OrderController::class, 'store']);
Route::get('/orders', [OrderController::class, 'index']);
