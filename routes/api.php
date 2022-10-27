<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\WatcherAntennaController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api_auth')->group(function () {
    Route::get('/antenas', [Api\AntennaController::class, 'getAntennas']);
    Route::get('v1/unique', [Api\UniqueItemController::class, 'getUniqueItems']);
});
Route::get('watcher/{name}', [WatcherAntennaController::class, 'getAntennaData']);
