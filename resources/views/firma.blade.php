@extends('plantilla')


@section('cabecera')
    
    <style>
            canvas {
            width: 500px;
            height: 250px;
            background-color: #0D0909;
        }

        #btn-enviar{
            width: 100%,
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
        <h1>Fecha: {{ $fecha }}</h1>
        <h2>Hora: {{ $hora }}</h2>
        <ul>
        @foreach ($equipos as $equipo)
            <li>{{ $equipo->nombre_articulo }} - {{ $equipo->descripcion_articulo }}</li>
        @endforeach
        </ul>

    </fieldset>



    <form action="">

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Recibe:</span>
            <input name="nombre_persona" type="text" class="form-control" placeholder="a aquien se entrega... " aria-label="Username" aria-describedby="basic-addon1">
        </div>

        <fieldset style="border: 1px solid black; display: inline-block;">
            <legend>firma</legend>
            <p>Firme en el espacio en negro</p>
            <canvas id="pizarra"></canvas>
            <button id="borrar" type="button" class="btn btn-danger">Corregir</button>
        </fieldset>

        <br>

        <button class="btn btn-success" id="btn-enviar" type="submit">Finalizar entrega</button>

    </form>

  




@endsection


@section('scripts')

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
        ctx.strokeStyle = '#fff';
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



</script>
  
  
@endsection