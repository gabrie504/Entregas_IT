<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Entrega;
use App\Models\Articulo;
use App\Models\DetalleArticulo;
use App\Models\PersonaRecibe;
use App\Models\PersonaDetalles;

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



    public function store(Request $request)
{

  
     
    $validateData = $request->validate([
        'nombre_persona' => 'required|string|max:255',
        'firma' => 'required|string|regex:/^data:image\/[a-z]+;base64,/',
    ]);

    $firma =  $request->input('firma');

    // Decodificar la imagen base64 a una imagen PNG
    $firmaBinary = base64_decode(str_replace('data:image/png;base64,', '', $firma));

    // Generar un nombre único para el archivo
    $filename = uniqid() . '.png';

    // Guardar la imagen en el disco
    Storage::disk('public')->put($filename, $firmaBinary);


/*     $firmaBinary = base64_decode($firma);
    $extension = 'png';
    $filename = uniqid() . '.' . $extension; // $extension es la extensión de la imagen (por ejemplo, jpg, png)

    Storage::disk('public')->put($filename, $firmaBinary);
 */


    $nombre_persona = $validateData['nombre_persona'];

    // Obtener la última entrega creada en la base de datos
    $ultimaEntrega = Entrega::latest()->first();
    $idEntrega = $ultimaEntrega->id_entrega;

    $personasDetalle = new PersonaDetalles();

    // Buscar una persona existente con el mismo nombre
    $personaExistente = PersonaRecibe::where('nombre_persona', $nombre_persona)->first();
    
    if ($personaExistente) {
        $personasDetalle->id_entrega = $idEntrega;
        $personasDetalle->id_persona = $personaExistente->id_persona;
        $personasDetalle->firma_encargado = $filename;
        $personasDetalle->save();

    } else {
        $personaNueva = new PersonaRecibe();
        $personaNueva->nombre_persona = $nombre_persona;
        $personaNueva->firma_persona = $filename;
        $personaNueva->save();


        $personasDetalle->id_entrega = $idEntrega;
        $personasDetalle->id_persona = $personaNueva->id;
        $personasDetalle->firma_encargado = $filename;
        $personasDetalle->save();
    }

    

    

    return redirect()->route('home');
}



}
