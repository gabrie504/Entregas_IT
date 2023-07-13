<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Prestamo; // Importar el modelo Prestamo

class PrestamoController extends EntregaController
{
    public function store(Request $request)
    {
        // Validando
        $validateData = $request->validate([
            'fecha_entrega' => 'required|string|date',
            'hora_entrega' => 'required|date_format:H:i',
            'foto_entrega' => 'required|image',
        ]);

        // Guardando la imagen en la carpeta uploads
        $image = $request->file('foto_entrega');
        $imageName = $image->store('images', 'public');

        // Creando una instancia del modelo Prestamo en lugar de Entrega
        $prestamo = new Prestamo(); // Utilizando el modelo Prestamo
        $prestamo->fecha_entrega = $validateData['fecha_entrega'];
        $prestamo->hora_entrega = $validateData['hora_entrega'];
        $prestamo->nombre_encargado = auth()->user()->name;
        $prestamo->foto_articulo = $imageName;
        $prestamo->estado_prestamo = 0;
            

        $prestamo->save();

        $id = 2;
        return redirect()->route('dispositivos.mostrar')->with('id', $id);

    }
}
