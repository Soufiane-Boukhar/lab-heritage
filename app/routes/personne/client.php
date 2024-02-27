<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Personne\PersonneController;

Route::prefix('client')->group(function () {
    Route::get('/', [PersonneController::class, 'index'])->name('client.index');
    Route::get('/form-ajouter', [PersonneController::class, 'create'])->name('client.create');
    Route::post('/ajouter', [PersonneController::class, 'store'])->name('client.store');
    Route::get('/{id}', [PersonneController::class, 'show'])->name('client.show');
    Route::get('/{id}/edit', [PersonneController::class, 'edit'])->name('client.edit');
    Route::post('/{id}/update', [PersonneController::class, 'update'])->name('client.update');
    Route::delete('/{id}/delete', [PersonneController::class, 'delete'])->name('client.delete');
});
