<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Entrega;

class EntregaController extends Controller
{
    public function index($id)
    {
        return view('crearEntrega', compact('id'));
    }

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

        $imageName=$image->store('images', 'public');





        $entrega = new Entrega();
        $entrega->fecha_entrega = $validateData['fecha_entrega'];
        $entrega->hora_entrega = $validateData['hora_entrega'];
        $entrega->nombre_encargado = auth()->user()->name;
        $entrega->foto_articulo = $imageName;

        $entrega->save();

        $id = 1;
        return redirect()->route('dispositivos.mostrar')->with('id', $id);
    }
}



