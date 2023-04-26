<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo; 

class DispositivoController extends Controller
{
    public function index(){

        $articulos = Articulo::all();
        return view('mostrarDispositivos', compact('articulos'));
    }

    public function store(){

    }

    public function destroy(Articulo $articulo)
{
    /*
    $articulo->delete();

    return redirect()->route('articulos.index')
        ->with('success', 'El artículo ha sido eliminado exitosamente.');

    */
}

}
