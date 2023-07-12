<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Prestamo;
use App\Models\Articulo;
use App\Models\DetalleArticulo;
use App\Models\PersonaRecibe;
use App\Models\PersonaDetalles;

class FirmaPrestamoController extends Controller
{
    public function index(){
        $ultimaPrestamo = Prestamo::max('id');
        
        $prestamo = prestamo::select('e.fecha_entrega', 'e.hora_entrega', 'da.descripcion_articulo', 'a.nombre_articulo')
            ->from('prestamos as e')
            ->join('detalleprestamos as da', 'e.id', '=', 'da.id_prestamo')
            ->join('articulos as a', 'da.id_articulo', '=', 'a.id_articulo')
            ->where('e.id', '=', $ultimaPrestamo)
            ->distinct()
            ->get();
        
        return view('firma', [
            'fecha' => $prestamo[0]->fecha_entrega,
            'hora' => $prestamo[0]->hora_entrega,
            'equipos' => $prestamo
        ]);
    }

    public function store(){
        
    }
}
