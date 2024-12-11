<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DatosArchivo;
use App\Models\Coordenada;

class ArchivoController extends Controller
{
    public function subir(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx',
        ]);

        $archivo = $request->file('archivo');
        $datosExcel = Excel::toArray([], $archivo);

        if (empty($datosExcel) || !isset($datosExcel[0])) {
            return back()->withErrors(['archivo' => 'El archivo no contiene datos.']);
        }

        $hoja = $datosExcel[0]; // Primera hoja
        $filaEncabezados = null;

        // Encuentra la fila que contiene los encabezados
        foreach ($hoja as $indice => $fila) {
            if (in_array('nombre', $fila) && in_array('email', $fila) && in_array('password', $fila)) {
                $filaEncabezados = $indice;
                break;
            }
        }

        if ($filaEncabezados === null) {
            return back()->withErrors(['archivo' => 'No se encontraron los encabezados requeridos en el archivo.']);
        }

        // Mapear los índices de las columnas de acuerdo con los encabezados
        $encabezados = $hoja[$filaEncabezados];
        $mapa = [
            'nombre' => array_search('nombre', $encabezados),
            'email' => array_search('email', $encabezados),
            'password' => array_search('password', $encabezados),
        ];

        // Procesa las filas que contienen datos
        foreach ($hoja as $indice => $fila) {
            // Omite las filas que están antes de los encabezados
            if ($indice <= $filaEncabezados) {
                continue;
            }

            // Guardar los datos en la tabla DatosArchivo
            $datos = new DatosArchivo();
            $datos->nombre = $fila[$mapa['nombre']] ?? null;
            $datos->email = $fila[$mapa['email']] ?? null;
            $datos->password = isset($fila[$mapa['password']]) ? bcrypt($fila[$mapa['password']]) : null;
            $datos->save();

            // Guardar las coordenadas de cada dato en la tabla Coordenada
            foreach ($mapa as $campo => $columna) {
                Coordenada::create([
                    'fila' => $indice + 1, // Sumar 1 para que coincida con Excel (inicio en 1)
                    'columna' => $columna + 1, // Sumar 1 porque Excel usa base 1
                    'celda' => chr(65 + $columna) . ($indice + 1), // Convierte columna a letra
                ]);
            }
        }

        return back()->with('success', 'Archivo procesado, datos y coordenadas guardados.');
    }
}
