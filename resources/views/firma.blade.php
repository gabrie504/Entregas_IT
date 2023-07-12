@extends('plantilla')


@section('cabecera')
    
<style>
    canvas {
        width: 500px;
        height: 250px;
        background-color: #fff;
    }

    .equipos-table {
        width: 100%;
        border-collapse: collapse;
    }

    .equipos-table th,
    .equipos-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .equipos-table th {
        background-color: #f2f2f2;
        text-align: left;
    }

    #btn-enviar {
        width: 100%;
        margin-bottom: 20px;
        margin-top: 20px;
    }
</style>
@endsection


@section('title')
    firma
@endsection

@section('content')

<fieldset>
    <legend style="border: 1px solid black; display: inline-block;">Informacion de la entrega</legend>
    <h3>Fecha: {{ $fecha }}</h1>
    <h3>Hora: {{ $hora }}</h2>
    <table class="equipos-table">
        <thead>
            <tr>
                <th style="width: 30%;">Articulo</th>
                <th style="width: 70%;">Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipos as $equipo)
            <tr>
                <td>{{ $equipo->nombre_articulo }}</td>
                <td>{{ $equipo->descripcion_articulo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</fieldset>
<br>

        @if(session('success'))
        <script>

            @if($id = 1)
                alert("{{ session('success') }}");
                window.location.href = "/historial";
            @elseif($id = 2)
                alert("{{ session('success') }}");
                window.location.href = "/";
            @endif
        </script>
        @else

                <form  action="{{secure_url('/firma1')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Recibe:</span>
                        <input name="nombre_persona" type="text" class="form-control" placeholder="a aquien se entrega... " aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <fieldset style="border: 1px solid black; display: inline-block;">
                        <legend>firma</legend>
                        <p>Firme en el espacio:</p>
                        <div style="position: relative;">
                            <canvas id="pizarra"></canvas>
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.1); pointer-events: none;"></div>
                        </div>
                        <input type="hidden" name="firma" id="firma">
                    </fieldset>
                    <button id="borrar" type="button" class="btn btn-danger" style="width: 100%; text-align: center;">Corregir Firma</button>

                    <br>

                    <button class="btn btn-success" id="btn-enviar" type="submit" onclick="guardarFirma()">Finalizar entrega</button>

                    {{-- <button class="btn btn-success" id="btn-enviar" type="submit">Finalizar entrega</button> --}}

                </form>

        @endif

    


@endsection


@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/4.1.5/signature_pad.umd.min.js" integrity="sha512-ngaalT22GGVs6hGMprLZ39ulFSdC/WUty7LR5AaFxpkDp5TUQ/w11WOIvZBktWOP/e9aA9m/xxpBUNDWpadROA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
<script>

    //======================================================================
// VARIABLES
//======================================================================
let miCanvas = document.querySelector('#pizarra');
let lineas = [];
let correccionX = 0;
let correccionY = 0;
let pintarLinea = false;
// Marca el nuevo punto
let nuevaPosicionX = 0;
let nuevaPosicionY = 0;

let posicion = miCanvas.getBoundingClientRect()
correccionX = posicion.x;
correccionY = posicion.y;

miCanvas.width = 500;
miCanvas.height = 250;

//======================================================================
// FUNCIONES
//======================================================================

/**
 * Funcion que empieza a dibujar la linea
 */
function empezarDibujo() {
    pintarLinea = true;
    lineas.push([]);
};

/**
 * Funcion que guarda la posicion de la nueva línea
 */
function guardarLinea() {
    lineas[lineas.length - 1].push({
        x: nuevaPosicionX,
        y: nuevaPosicionY
    });
}

/**
 * Funcion dibuja la linea
 */
function dibujarLinea(event) {
    event.preventDefault();
    if (pintarLinea) {
        let ctx = miCanvas.getContext('2d')
        // Estilos de linea
        ctx.lineJoin = ctx.lineCap = 'round';
        ctx.lineWidth = 2;
        // Color de la linea
        ctx.strokeStyle = '#0D0909';
        // Marca el nuevo punto
        if (event.changedTouches == undefined) {
            // Versión ratón
            nuevaPosicionX = event.layerX;
            nuevaPosicionY = event.layerY;
        } else {
            // Versión touch, pantalla tactil
            nuevaPosicionX = event.changedTouches[0].pageX - correccionX;
            nuevaPosicionY = event.changedTouches[0].pageY - correccionY;
        }
        // Guarda la linea
        guardarLinea();
        // Redibuja todas las lineas guardadas
        ctx.beginPath();
        lineas.forEach(function (segmento) {
            ctx.moveTo(segmento[0].x, segmento[0].y);
            segmento.forEach(function (punto, index) {
                ctx.lineTo(punto.x, punto.y);
            });
        });
        ctx.stroke();
    }
}

/**
 * Funcion que deja de dibujar la linea
 */
function pararDibujar () {
    pintarLinea = false;
    guardarLinea();
    
}



//======================================================================
// EVENTOS
//======================================================================

// Eventos raton
miCanvas.addEventListener('mousedown', empezarDibujo, false);
miCanvas.addEventListener('mousemove', dibujarLinea, false);
miCanvas.addEventListener('mouseup', pararDibujar, false);

// Eventos pantallas táctiles
miCanvas.addEventListener('touchstart', empezarDibujo, false);
miCanvas.addEventListener('touchmove', dibujarLinea, false);

document.getElementById('firma').value = pizarra.toDataURL();
//======================================================================
//BORRAR FIRMA
// Obtener referencia al botón de borrar
let botonBorrar = document.getElementById('borrar');

// Agregar un evento click al botón
botonBorrar.addEventListener('click', function() {
  // Obtener el contexto del canvas
  let ctx = miCanvas.getContext('2d');
  // Borrar todo el contenido del canvas
  ctx.clearRect(0, 0, miCanvas.width, miCanvas.height);
  // Reiniciar la variable de lineas
  lineas = [];
});


function guardarFirma() {
    // Obtener el canvas y el contexto
    var canvas = document.getElementById("pizarra");
    var contexto = canvas.getContext("2d");

    // Obtener la imagen en formato base64
    var imagenBase64 = canvas.toDataURL("image/png");

    // Asignar la imagen al input
    document.getElementById("firma").value = imagenBase64;
}

 
</script>
  
  
@endsection




