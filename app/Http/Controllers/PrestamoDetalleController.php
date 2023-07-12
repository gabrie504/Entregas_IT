<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\DetallePrestamo;
use App\Models\Prestamo;


class PrestamoDetalleController extends EntrgasDetalleController
{

    public function store(Request $request)
    {


        $equipos = $request->input('equipos');

        // Obtener la última entrega creada en la base de datos
        $ultimoPrestamo = Prestamo::latest()->first();
        $idPrestamo = $ultimoPrestamo->id;
       
        foreach ($equipos as $equipo) {
            $nombreArticulo = $equipo['nombre'];
            $descripcionArticulo = $equipo['descripcion'];

            // Verificar si el artículo ya existe en la base de datos
            $articuloExistente = Articulo::where('nombre_articulo', $nombreArticulo)->first();

            $detallePrestamo = new DetallePrestamo();
            if ($articuloExistente) {
                // Si el artículo ya existe, simplemente asignarlo al detalle de artículos
                $detallePrestamo->id_prestamo = $idPrestamo;
                $detallePrestamo->id_articulo = $articuloExistente->id_articulo;
                $detallePrestamo->descripcion_articulo = $descripcionArticulo;
                $detallePrestamo->save();
            } else {
                // Si el artículo no existe, crear un nuevo artículo y asignarlo al detalle de artículos
                $articuloNuevo = new Articulo();
                $articuloNuevo->nombre_articulo = $nombreArticulo;
                $articuloNuevo->save();


                $detallePrestamo->id_prestamo = $idPrestamo;
                $detallePrestamo->id_articulo = $articuloNuevo->id;
                $detallePrestamo->descripcion_articulo = $descripcionArticulo;
                $detallePrestamo->save();
            }
        }

        return response()->json(['msj' => 'se guardo en la tabla prestamo detalle']);
    }
}
