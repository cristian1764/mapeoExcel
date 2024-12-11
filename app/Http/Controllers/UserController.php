<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatosArchivo; 
use App\Models\User; // Asegúrate de que el namespace sea correcto

class UserController extends Controller
{
    public function getUsers() {
        $users = User::all();
        return response()->json($users);
    }

    public function getDatosArchivo() {
        $datos = DatosArchivo::all(); // Uso correcto del modelo
        return response()->json($datos); // Retorna los datos en formato JSON
    }
}
