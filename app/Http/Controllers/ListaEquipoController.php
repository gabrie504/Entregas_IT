<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;

class ListaEquipoController extends Controller
{

    

    public function index()
    {
        $articulos = Articulo::paginate(10);

        return view('equipos/verEquipos', compact('articulos'));
    }
    
    
}
