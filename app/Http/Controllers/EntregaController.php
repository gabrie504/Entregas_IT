<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrega;

class EntregaController extends Controller
{

    public function index(){
        return view('crearEntrega');
    }



    public function store(Request $request){
        
        //validando
        $validateData = $request->validate([
            
			'fecha_entrega' => 'required|string|date',
            'hora_entrega' => 'required|date_format:H:i',
			'nombre_encargado' => 'required|string|max:255',

        ]);

        $entrega = new Entrega();
        $entrega-> fecha_entrega = $validateData['fecha_entrega'];
        $entrega-> hora_entrega = $validateData['hora_entrega'];
        $entrega-> nombre_encargado = $validateData['nombre_encargado'];


     

        $entrega->save();

          // Obtener el ID de la última entrega creada
            $idEntrega = $entrega->id_entrega;
            
       return redirect()->route('dispositivos.mostrar')->with('idEntrega', $idEntrega);
        

    }
}
