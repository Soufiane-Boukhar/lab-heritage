<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Personne\PersonneController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('membre')->group(function () {
    Route::get('/', [PersonneController::class, 'index'])->name('membre.index');
    Route::get('/form-ajouter', [PersonneController::class, 'create'])->name('membre.create');
    Route::post('/ajouter', [PersonneController::class, 'store'])->name('membre.store');
    Route::get('/{id}', [PersonneController::class, 'show'])->name('membre.show');
    Route::get('/{id}/edit', [PersonneController::class, 'edit'])->name('membre.edit');
    Route::post('/{id}/update', [PersonneController::class, 'update'])->name('membre.update');
    Route::delete('/{id}/delete', [PersonneController::class, 'delete'])->name('membre.delete');
});

Route::prefix('client')->group(function () {
    Route::get('/', [PersonneController::class, 'index'])->name('client.index');
    Route::get('/form-ajouter', [PersonneController::class, 'create'])->name('client.create');
    Route::post('/ajouter', [PersonneController::class, 'store'])->name('client.store');
    Route::get('/{id}', [PersonneController::class, 'show'])->name('client.show');
    Route::get('/{id}/edit', [PersonneController::class, 'edit'])->name('client.edit');
    Route::post('/{id}/update', [PersonneController::class, 'update'])->name('client.update');
    Route::delete('/{id}/delete', [PersonneController::class, 'delete'])->name('client.delete');
});
