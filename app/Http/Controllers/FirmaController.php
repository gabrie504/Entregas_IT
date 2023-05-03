<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Articulo;
use App\Models\DetalleArticulo;

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
}
