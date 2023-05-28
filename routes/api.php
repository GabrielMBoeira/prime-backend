<?php

use App\Http\Controllers\API\RevenueController;
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

Route::get('revenues', [RevenueController::class, 'index']);
Route::post('revenues', [RevenueController::class, 'store']);
Route::get('revenues/{id}/edit', [RevenueController::class, 'edit']);
Route::put('revenues/{id}/edit', [RevenueController::class, 'update']);
Route::delete('revenues/{id}/delete', [RevenueController::class, 'destroy']);
