<?php

use App\Http\Controllers\PaidController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
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
Route::post('ipn', [PaidController::class, 'notificationIpn']);
Route::get('/stores/{store}/skus', [StoreController::class, 'skus']);
Route::post('/stores/update/stock',[StoreController::class, 'stock']);
Route::post('/stores/restore/stock',[StoreController::class, 'restock']);

