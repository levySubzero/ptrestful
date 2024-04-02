<?php

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

Route::get('/all_users', [App\Http\Controllers\Api\HomeController::class, 'allInfo']);
Route::put('/update_info/{id?}', [App\Http\Controllers\Api\HomeController::class, 'updateInfo']);
Route::post('/store_info', [App\Http\Controllers\Api\HomeController::class, 'storeInfo']);
Route::delete('/deleteInfo/{id}', [App\Http\Controllers\Api\HomeController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
