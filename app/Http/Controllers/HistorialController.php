<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Entrega;


class HistorialController extends Controller
{
    

    public function index(Request $request)
    {

        /*
        SELECT entregas.id_entrega, entregas.fecha_entrega, entregas.hora_entrega, entregas.nombre_encargado, entregas.foto_articulo,
		detallearticulos.descripcion_articulo, 
		articulos.nombre_articulo,
		detallepersonas.firma_encargado,
		personas.nombre_persona
FROM entregas
INNER JOIN detallearticulos ON detallearticulos.id_entrega = entregas.id_entrega
INNER JOIN articulos ON articulos.id_articulo = detallearticulos.id_articulo
INNER JOIN detallepersonas ON detallepersonas.id_entrega = entregas.id_entrega
INNER JOIN personas ON personas.id_persona = detallepersonas.id_persona;

        */
        $entregas = DB::table('entregas')
            ->join('detallearticulos', 'detallearticulos.id_entrega', '=', 'entregas.id_entrega')
            ->join('articulos', 'articulos.id_articulo', '=', 'detallearticulos.id_articulo')
            ->join('detallepersonas', 'detallepersonas.id_entrega', '=', 'entregas.id_entrega')
            ->join('personas', 'personas.id_persona', '=', 'detallepersonas.id_persona')
            ->select('entregas.id_entrega', 'entregas.fecha_entrega', 'entregas.hora_entrega', 'entregas.nombre_encargado', 'entregas.foto_articulo',
                'detallearticulos.descripcion_articulo',
                'articulos.nombre_articulo',
                'detallepersonas.firma_encargado',
                'personas.nombre_persona')
            ->orderBy('entregas.fecha_entrega', 'desc')
            ->paginate(15);
    
        return view('historial/verHistorial', compact('entregas'));
    }
    

    public function show($id)
    {
        $entrega = DB::table('entregas')
            ->join('detallearticulos', 'detallearticulos.id_entrega', '=', 'entregas.id_entrega')
            ->join('articulos', 'articulos.id_articulo', '=', 'detallearticulos.id_articulo')
            ->join('detallepersonas', 'detallepersonas.id_entrega', '=', 'entregas.id_entrega')
            ->join('personas', 'personas.id_persona', '=', 'detallepersonas.id_persona')
            ->where('entregas.id_entrega', $id)
            ->first();

        return view('historial/entregaUnica', compact('entrega'));
    } 
}
