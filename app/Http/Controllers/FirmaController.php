<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrega;
use App\Models\Articulo;
use App\Models\DetalleArticulo;

class FirmaController extends Controller
{
        public function index(){

            $ultimaEntrega = Entrega::latest()->first();
            $entrega = Entrega::find($ultimaEntrega);

            $detalles = DetalleArticulo::where('id_entrega', $entrega->id_entrega)
                        ->orderBy('created_at', 'desc')
                        ->get();

            $articulos = collect();

            foreach ($detalles as $detalle) {
                $articulo = Articulo::find($detalle->id_articulo);
                $articulo->descripcion = $detalle->descripcion_articulo;
                $articulos->push($articulo);
            }

            return view('firma', compact('entrega', 'articulos', 'detalles'));


        }
}
