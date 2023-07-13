<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prestamo;
use App\Models\Articulo;
use App\Models\DetallePrestamo;
use App\Models\PersonaDetalle;
use App\Models\PersonaRecibe;


class HistorialPrestamoController extends Controller
{
    public function index(Request $request)
    {


        $prestamos = DB::table('prestamos')
            ->join('detalleprestamos', 'detalleprestamos.id_prestamo', '=', 'prestamos.id')
            ->join('articulos', 'articulos.id_articulo', '=', 'detalleprestamos.id_articulo')
            ->join('detallepersonas', 'detallepersonas.id_prestamo', '=', 'prestamos.id')
            ->join('personas', 'personas.id_persona', '=', 'detallepersonas.id_persona')
            ->select('prestamos.id', 'prestamos.fecha_entrega', 'prestamos.hora_entrega', 'prestamos.nombre_encargado', 'prestamos.foto_articulo',
                'detalleprestamos.descripcion_articulo',
                'articulos.nombre_articulo',
                'detallepersonas.firma_encargado',
                'personas.nombre_persona')
            ->orderBy('prestamos.id', 'desc')
            ->distinct()
            ->paginate(15);
      
        
        return view('historial/verHistorialPrestamo', compact('prestamos'));
    }
    

    public function show($id)
  {


$prestamo = prestamo::select('e.fecha_entrega', 'e.hora_entrega', 'da.descripcion_articulo', 'a.nombre_articulo',
                            'e.nombre_encargado', 'e.foto_articulo', 'personas.nombre_persona', 'detallepersonas.firma_encargado')
    ->from('prestamos as e')
    ->join('detalleprestamos as da', 'e.id', '=', 'da.id_prestamo')
    ->join('articulos as a', 'da.id_articulo', '=', 'a.id_articulo')
    ->join('detallepersonas', 'detallepersonas.id_prestamo', '=', 'e.id')
    ->join('personas', 'personas.id_persona', '=', 'detallepersonas.id_persona')
    ->where('e.id', '=', $id)
    ->distinct()
    ->get();



            
           
          
        return view('historial/prestamoUnico', [
            'fecha' => $prestamo[0]->fecha_entrega,
            'hora' => $prestamo[0]->hora_entrega,
            'encargado' => $prestamo[0]->nombre_encargado,
            'foto' => $prestamo[0]->foto_articulo,
            'equipos' => $prestamo,
            'recibe' => $prestamo[0]->nombre_persona,
            'firma' => $prestamo[0]->firma_encargado

        ] );
    }  
}
