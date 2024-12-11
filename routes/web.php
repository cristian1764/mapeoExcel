<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArchivoController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');
    

    // Subir archivo
    Route::get('/subir', [ArchivoController::class, 'mostrarFormulario'])->name('subir');
Route::post('/subir', [ArchivoController::class, 'subir'])->name('archivo.subir');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
