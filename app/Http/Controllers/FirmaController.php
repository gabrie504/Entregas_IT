<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Articulo;
use App\Models\DetalleArticulo;
use App\Models\PersonaRecibe;
use App\Models\PersonaDetalles;

class FirmaController extends Controller
{
    public function index(){
        $ultimaEntrega = Entrega::max('id_entrega');
        
        $entregas = Entrega::select('e.fecha_entrega', 'e.hora_entrega', 'da.descripcion_articulo', 'a.nombre_articulo')
            ->from('Entregas as e')
            ->join('DetalleArticulos as da', 'e.id_entrega', '=', 'da.id_entrega')
            ->join('Articulos as a', 'da.id_articulo', '=', 'a.id_articulo')
            ->where('e.id_entrega', '=', $ultimaEntrega)
            ->distinct()
            ->get();
        
        return view('firma', [
            'fecha' => $entregas[0]->fecha_entrega,
            'hora' => $entregas[0]->hora_entrega,
            'equipos' => $entregas
        ]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'nombre_persona' => 'required|string|max:255',
        ]);

        $nombre_persona = $validateData['nombre_persona'];

        
        // Obtener la última entrega creada en la base de datos
        $ultimaEntrega = Entrega::latest()->first();
        $idEntrega = $ultimaEntrega->id_entrega;

        $personaExistente = PersonaRecibe::where('nombre_persona', $nombre_persona);

        $personaRecibe = new PersonaRecibe();
        $personasDetalle = new PersonaDetalles();
        if($personaExistente){
           
            $personasDetalle->id_entrega = $idEntrega;
            $personasDetalle->id_persona = $personaExistente->id_persona;
        }else{
            $personaNueva = new PersonaRecibe();
            $personaNueva->nombre_persona  = $nombre_persona;
            $personaNueva->save();

            $personasDetalle->id_entrega = $idEntrega;
            $personasDetalle->id_persona = $personaRecibe->id_persona;
        }

        $personasDetalle->save();


        return response()->json(['msj' => 'se guardo']);

    }
}
