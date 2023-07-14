<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prestamo;
use App\Models\PrestamoDevuelve;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

/* use App\Models\Articulo;
use App\Models\DetallePersona;
use App\Models\DetallePrestamo;
use App\Models\PersonaDetalles;
use App\Models\PersonaRecibe; */



class HistorialPrestamoController extends Controller
{
    public function index(Request $request)
    {


        //envia una lista de prestamos a la vista para poder accder a ellos y verlo individualmente
        $prestamos = DB::table('prestamos')
            ->join('detalleprestamos', 'detalleprestamos.id_prestamo', '=', 'prestamos.id')
            ->join('articulos', 'articulos.id_articulo', '=', 'detalleprestamos.id_articulo')
            ->join('detallepersonas', 'detallepersonas.id_prestamo', '=', 'prestamos.id')
            ->join('personas', 'personas.id_persona', '=', 'detallepersonas.id_persona')
            ->select('prestamos.id', 'prestamos.fecha_entrega', 'prestamos.hora_entrega', 'prestamos.nombre_encargado', 'prestamos.foto_articulo','estado_prestamo',
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

// trae los todos los datos de un prestamo segun su id y los envia a la vista oara ser visualizados
$prestamo = prestamo::select('e.fecha_entrega', 'e.hora_entrega', 'e.estado_prestamo','da.descripcion_articulo', 'a.nombre_articulo',
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
            'estado_prestamo' => $prestamo[0]->estado_prestamo,
            'encargado' => $prestamo[0]->nombre_encargado,
            'foto' => $prestamo[0]->foto_articulo,
            'equipos' => $prestamo,
            'recibe' => $prestamo[0]->nombre_persona,
            'firma' => $prestamo[0]->firma_encargado

        ] );
    }


    public function notaupdate($id) {
    // trae los todos los datos de un prestamo segun su id y los envia a la vista oara ser visualizados
    $prestamo = prestamo::select('e.fecha_entrega', 'e.hora_entrega', 'e.estado_prestamo','da.descripcion_articulo', 'a.nombre_articulo',
                            'e.nombre_encargado', 'e.foto_articulo', 'personas.nombre_persona', 'detallepersonas.firma_encargado')
    ->from('prestamos as e')
    ->join('detalleprestamos as da', 'e.id', '=', 'da.id_prestamo')
    ->join('articulos as a', 'da.id_articulo', '=', 'a.id_articulo')
    ->join('detallepersonas', 'detallepersonas.id_prestamo', '=', 'e.id')
    ->join('personas', 'personas.id_persona', '=', 'detallepersonas.id_persona')
    ->where('e.id', '=', $id)
    ->distinct()
    ->get();






        return view('historial/notaDevuelve', [
            'id' => $id,
            'fecha' => $prestamo[0]->fecha_entrega,
            'hora' => $prestamo[0]->hora_entrega,
            'estado_prestamo' => $prestamo[0]->estado_prestamo,
            'encargado' => $prestamo[0]->nombre_encargado,
            'foto' => $prestamo[0]->foto_articulo,
            'equipos' => $prestamo,
            'recibe' => $prestamo[0]->nombre_persona,
            'firma' => $prestamo[0]->firma_encargado

        ] );
    }

    public function update(Request $request){

        /* dd($request); */
        $validateData = $request->validate([

            'foto_entrega' => 'required|image',
            'encargado_devuelve' => 'required|string|max:255',
            'firma' => 'required|string|regex:/^data:image\/[a-z]+;base64,/',
        ]);

           $image = $request->file('foto_entrega');
           $imageName=$image->store('images', 'public');


           $firma =  $request->input('firma');
           // Decodificar la imagen base64 a una imagen PNG
           $firmaBinary = base64_decode(str_replace('data:image/png;base64,', '', $firma));
           // Generar un nombre único para el archivo
           $filename = uniqid() . '.png';
           // Guardar la imagen en el disco
           Storage::disk('public')->put($filename, $firmaBinary);


           $devolucion = new PrestamoDevuelve();

           $devolucion->foto_devolucion = $imageName;
           $devolucion->encargado_recibe = auth()->user()->name;
           $devolucion->nota_devuelve = $request->input('nota');
           $devolucion->firma_devolucion = $filename;
           $devolucion->nombre_devuelve = $validateData['encargado_devuelve'];

           $devolucion->save();


           // Setear el mensaje de éxito en la sesión
     Session::flash('success', 'La entrega se creó con éxito');

     return back()->with('success', 'La entrega se creó con éxito');


    }
}
