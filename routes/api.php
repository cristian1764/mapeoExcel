<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/getUsers', [UserController::class, 'getUsers']); // Nombre del controlador correcto
Route::get('/getdatos_archivo', [UserController::class, 'getDatosArchivo']); // Método correcto

Route::get('/getUser/{id}', [UserController::class, 'getUser']);
Route::post('/insertUser', [UserController::class, 'insertUser']);
Route::put('/updateUser/{id}', [UserController::class, 'updateUser']);

