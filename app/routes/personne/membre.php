<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Personne\PersonneController; // Adjust the namespace as needed

// Define the namespace for controllers within the personne folder
$namespace = 'App\Http\Controllers\Personne';

// Namespace all routes within this file
Route::namespace($namespace)->group(function () {
    Route::prefix('membre')->group(function () {
        Route::get('/', [PersonneController::class, 'index'])->name('membre.index');
        Route::get('/form-ajouter', [PersonneController::class, 'create'])->name('membre.create');
        Route::post('/ajouter', [PersonneController::class, 'store'])->name('membre.store');
        Route::get('/{id}', [PersonneController::class, 'show'])->name('membre.show');
        Route::get('/{id}/edit', [PersonneController::class, 'edit'])->name('membre.edit');
        Route::post('/{id}/update', [PersonneController::class, 'update'])->name('membre.update');
        Route::delete('/{id}/delete', [PersonneController::class, 'delete'])->name('membre.delete');
    });
});
