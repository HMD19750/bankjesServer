<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankjeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/area', [BankjeController::class, 'index']);
Route::get('/area/test', [BankjeController::class, 'index']);
Route::delete('/bankje/{bankje}', [BankjeController::class, 'delete']);
Route::post('/bankje', [BankjeController::class, 'store']);
Route::post('/bankje/confirm/{bankje}', [BankjeController::class, 'confirm']);
Route::post('/bankje/touch', [BankjeController::class, 'touch']);