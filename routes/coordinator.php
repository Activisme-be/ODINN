<?php

/*
|--------------------------------------------------------------------------
| Coordinator Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register coordinator web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Inventory\CoordinatorController;

Route::view('/foutmelding/geen-locatie', 'errors.no-location')->name('errors.no-location');


Route::get('/inventaris', [CoordinatorController::class, 'index'])->name('coordinator.home');
Route::get('/nieuw-item', [CoordinatorController::class, 'create'])->name('coordinator.inventory.create');
Route::post('/nieuw-item', [CoordinatorController::class, 'store'])->name('coordinator.inventory.create');
Route::post('/inventaris/zoeken', [CoordinatorController::class, 'search'])->name('coordinator.inventory.search');
