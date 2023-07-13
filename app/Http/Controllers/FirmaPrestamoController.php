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
        
        return view('firmaPrestamo', [
            'fecha' => $prestamo[0]->fecha_entrega,
            'hora' => $prestamo[0]->hora_entrega,
            'equipos' => $prestamo
        ]);
    }

    public function store(Request $request){
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




    $nombre_persona = $validateData['nombre_persona'];

    //obtener el ultimo prestamo
    $ultimoPrestamo = Prestamo::latest()->first();
    $idPrestamo = $ultimoPrestamo->id;

    $personasDetalle = new PersonaDetalles();

        // Buscar una persona existente con el mismo nombre
        $personaExistente = PersonaRecibe::where('nombre_persona', $nombre_persona)->first();


        if ($personaExistente) {
            $personasDetalle->id_prestamo = $idPrestamo;
            $personasDetalle->id_persona = $personaExistente->id_persona;
            $personasDetalle->firma_encargado = $filename;
            $personasDetalle->save();
    
        } else {
            $personaNueva = new PersonaRecibe();
            $personaNueva->nombre_persona = $nombre_persona;
            $personaNueva->firma_persona = $filename;
            $personaNueva->save();
    
    
            $personasDetalle->id_prestamo = $idPrestamo;
            $personasDetalle->id_persona = $personaNueva->id;
            $personasDetalle->firma_encargado = $filename;
            $personasDetalle->save();
        }
    
         // Setear el mensaje de éxito en la sesión
         Session::flash('success', 'La entrega se creó con éxito');
    
         return back()->with('success', 'La entrega se creó con éxito');

    }
}
