<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AntenaController;
use App\Http\Controllers\WorkplaceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\WorkplaceAntentaController;
use App\Http\Controllers\RegistrationBoxController;
use \App\Http\Controllers\WatcherAntennaController;

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
Route::resource('antena', AntenaController::class)
    ->name('index', 'antena.index')
    ->name('create','antena.create')
    ->name('show','antena.show')
    ->name('edit','antena.edit');
Route::resource('workplace', WorkplaceController::class)->only('index', 'show', 'destroy')
    ->name('index', 'workplace.index')
    ->name('show', 'workplace.show');
Route::resource('workplace.antena', WorkplaceAntentaController::class)->only('create', 'destroy');
Route::resource('item', ItemController::class)->only('index', 'edit', 'update')
    ->name('index', 'item.index')
    ->name('edit', 'item.edit');
Route::resource('registrationBox', RegistrationBoxController::class)
    ->name('index', 'registrationBox.index')
    ->name('create','registrationBox.create')
    ->name('show','registrationBox.show')
    ->name('edit','registrationBox.edit');
Route::name('registrationBox.')->group(function() {
    Route::get('/deleted_list', [RegistrationBoxController::class, 'listDeleted'])->name('listDeleted');
    Route::post('/deleted_list/restore/{registrationBox}', [RegistrationBoxController::class, 'restore'])->name('restore');
    Route::post('/rssi_store/{registrationBox}', [RegistrationBoxController::class, 'rssiStore'])->name('rssi_store');
});
Route::name('watcher.')->group(function() {
    Route::get('/watcher/antenna/{registrationBox}', [WatcherAntennaController::class, 'getAntennaData'])->name('antennaData');
    Route::get('/watcher/item_unique', [WatcherAntennaController::class, 'getUniqueItemByItemId'])->name('getUniqueItemByItem');
    Route::post('/watcher/item_unique/{name}', [WatcherAntennaController::class, 'uniqueItemToPlug'])->name('unique_item_to_plug');
    Route::post('/watcher/item_unique/disable/{uniqueItem}', [WatcherAntennaController::class, 'uniqueItemDisable'])->name('unique_item_disable');
});

