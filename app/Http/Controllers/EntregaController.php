<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Entrega;

class EntregaController extends Controller
{
    public function index()
    {
        return view('crearEntrega');
    }

    public function store(Request $request)
    {


  
        // Validando
        $validateData = $request->validate([
            'fecha_entrega' => 'required|string|date',
            'hora_entrega' => 'required|date_format:H:i',
            'nombre_encargado' => 'required|string|max:255',
            'foto_entrega' => 'required|image',
        ]);

     
   
       // Guardando la imagen en la carpeta uploads
        $image = $request->file('foto_entrega');
        /* $imageName = time().'.'.$image->getClientOriginalExtension(); */
       /*  dd($imageName); */
        $imageName=$image->store('images', 'public');
 

   

        $entrega = new Entrega();
        $entrega->fecha_entrega = $validateData['fecha_entrega'];
        $entrega->hora_entrega = $validateData['hora_entrega'];
        $entrega->nombre_encargado = $validateData['nombre_encargado'];
        $entrega->foto_articulo = $imageName;

        $entrega->save();

        return redirect()->route('dispositivos.mostrar');
    }
}


/* namespace App\Http\Controllers;

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
            
            'foto_entrega' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


                // Guardando la imagen en la carpeta uploads
                $image = $request->file('foto_entrega');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('uploads'), $imageName);

        $entrega = new Entrega();
        $entrega-> fecha_entrega = $validateData['fecha_entrega'];
        $entrega-> hora_entrega = $validateData['hora_entrega'];
        $entrega-> nombre_encargado = $validateData['nombre_encargado'];
        
        

     

        $entrega->save();

          // Obtener el ID de la última entrega creada
            $idEntrega = $entrega->id_entrega;
            
       return redirect()->route('dispositivos.mostrar')->with('idEntrega', $idEntrega);
        

    }
} */
 