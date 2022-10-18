<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AntenaController;
use App\Http\Controllers\WorkplaceController;
use App\Http\Controllers\WorkplaceAntentaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$basePath = base_path('routes/web');

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::prefix('auth')->name('auth.')->group($basePath . '/auth.php');
Route::resource('antena', AntenaController::class);
Route::resource('workplace', WorkplaceController::class)->only('index', 'show', 'destroy');
Route::resource('workplace.antena', WorkplaceAntentaController::class)->only('create', 'destroy');

