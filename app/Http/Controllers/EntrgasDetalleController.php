<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\DetalleArticulo;
use App\Models\Entrega;

class EntrgasDetalleController extends Controller
{

    public function searchArticulos(Request $request){
    $term = $request->input('term');

    $articulos = Articulo::where('nombre_articulo', 'LIKE', '%'.$term.'%')->get(['nombre_articulo']);

    $result = [];
    foreach ($articulos as $articulo) {
        $result[] = $articulo->nombre_articulo;
    }

    return response()->json($result);
}


    public function index(){

        $articulos = Articulo::pluck('nombre_articulo')->all();
        return view('mostrarDispositivos', compact('articulos'));

    }

    public function store(Request $request)
    {


        $equipos = $request->input('equipos');

        // Obtener la última entrega creada en la base de datos
        $ultimaEntrega = Entrega::latest()->first();
        $idEntrega = $ultimaEntrega->id_entrega;

        foreach ($equipos as $equipo) {
            $nombreArticulo = $equipo['nombre'];
            $descripcionArticulo = $equipo['descripcion'];

            // Verificar si el artículo ya existe en la base de datos
            $articuloExistente = Articulo::where('nombre_articulo', $nombreArticulo)->first();

            $detalleArticulo = new DetalleArticulo();
            if ($articuloExistente) {
                // Si el artículo ya existe, simplemente asignarlo al detalle de artículos
                $detalleArticulo->id_entrega = $idEntrega;
                $detalleArticulo->id_articulo = $articuloExistente->id_articulo;
                $detalleArticulo->descripcion_articulo = $descripcionArticulo;
                $detalleArticulo->save();
            } else {
                // Si el artículo no existe, crear un nuevo artículo y asignarlo al detalle de artículos
                $articuloNuevo = new Articulo();
                $articuloNuevo->nombre_articulo = $nombreArticulo;
                $articuloNuevo->save();

                
                $detalleArticulo->id_entrega = $idEntrega;
                $detalleArticulo->id_articulo = $articuloNuevo->id;
                $detalleArticulo->descripcion_articulo = $descripcionArticulo;
                $detalleArticulo->save();
            }
        }

        return response()->json(['msj' => 'se guardo']);
    }
}
