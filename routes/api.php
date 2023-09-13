<?php

use App\Http\Controllers\AdditiveController;
use App\Http\Controllers\MealController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/additives', [AdditiveController::class, 'index']);
Route::get('/additives/{additive_id}', [AdditiveController::class, 'show']);
Route::get('/meals', [MealController::class, 'index']);
Route::get('/meals/{meal_id}', [MealController::class, 'show']);
