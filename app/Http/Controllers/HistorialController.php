<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Entrega;
use App\Models\Articulo;
use App\Models\DetalleArticulo;
use App\Models\PersonaDetalle;
use App\Models\PersonaRecibe;



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
            ->orderBy('entregas.id_entrega', 'desc')
            ->distinct()
            ->paginate(15);
    
        
        return view('historial/verHistorial', compact('entregas'));
    }
    

    public function show($id)
  {
/*     $entrega = Entrega::join('detallearticulos', 'detallearticulos.id_entrega', '=', 'entregas.id_entrega')
    ->join('articulos', 'articulos.id_articulo', '=', 'detallearticulos.id_articulo')
    ->join('detallepersonas', 'detallepersonas.id_entrega', '=', 'entregas.id_entrega')
    ->join('personas', 'personas.id_persona', '=', 'detallepersonas.id_persona')
    ->where('entregas.id_entrega', $id)
    ->first();
 */
$entrega = entrega::select('e.fecha_entrega', 'e.hora_entrega', 'da.descripcion_articulo', 'a.nombre_articulo',
                            'e.nombre_encargado', 'e.foto_articulo', 'personas.nombre_persona', 'detallepersonas.firma_encargado')
    ->from('entregas as e')
    ->join('detallearticulos as da', 'e.id_entrega', '=', 'da.id_entrega')
    ->join('articulos as a', 'da.id_articulo', '=', 'a.id_articulo')
    ->join('detallepersonas', 'detallepersonas.id_entrega', '=', 'e.id_entrega')
    ->join('personas', 'personas.id_persona', '=', 'detallepersonas.id_persona')
    ->where('e.id_entrega', '=', $id)
    ->distinct()
    ->get();



            
           
          
        return view('historial/entregaUnica', [
            'fecha' => $entrega[0]->fecha_entrega,
            'hora' => $entrega[0]->hora_entrega,
            'encargado' => $entrega[0]->nombre_encargado,
            'foto' => $entrega[0]->foto_articulo,
            'equipos' => $entrega,
            'recibe' => $entrega[0]->nombre_persona,
            'firma' => $entrega[0]->firma_encargado

        ] );
    }  
}
