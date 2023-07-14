@extends('plantilla')

@section('title')
    Entrega Única
@endsection

@section('content')
<h1>Nota devuelve</h1>
<div class="container">
    <h2 class="text-center d-print-none">DEPARTAMENTO DE IT</h2>
    <h6 class="text-center d-print-none">COMPROBANTE DE ENTREGA DE EQUIPO/ACCESORIOS</h6>
    <hr class="d-print-none">
    <p class="text-center d-print-none">Fecha: {{ $fecha }}</p>
    <p class="text-center d-print-none">Hora: {{ $hora }}</p>
    <hr class="d-print-none">

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detalles del Prestamo</h5>
                    <div class="row">
                        <div class="col-md-6 text-center"> <!-- Agregado "text-center" para centrar la imagen -->

                            <img src="{{ secure_asset('storage/'.$foto) }}" class="img-fluid img-thumbnail" alt="Foto del Artículo" style="max-width: 130px; margin: auto;">



                        </div>
                        <div class="col-md-6">
                            <table class="equipos-table  table table-light table-striped table table-responsive">
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
                        </div>
                    </div>
                    <div class="text-center">
                        <p>Firma de quien Recibe:</p>
                        <img src="{{ secure_asset('storage/'.$firma) }}" class="img-fluid img-thumbnail" alt="Firma del Encargado" style="max-width: 150px;">
                    </div>
                    <p class="text-center">Se presta a: {{ $recibe }}</p>
                    <p class="text-center">Colaborador que entrega de  IT: {{ $encargado }}</p>
                    <p><strong>Se hace constar que el equipo se entrega en óptimas condiciones y ha sido revisado por quien lo recibe</strong></p>
                    <hr>

                    <form action="{{ secure_url('/devuelveprestamo', ['id' => $id]) }}"  enctype="multipart/form-data">

                    {{-- ******************************tomar la foto de lo que se devuelve ************************************************ --}}
                        <div class="form-group">
                            <label for="foto_entrega">Foto de entrega</label>
                            <hr>
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary mr-2" id="tomar-foto-btn" style="width: 100%;">
                                    <i class="bi bi-camera">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                                            <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z"/>
                                            <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </i>
                                </button>


                                <button type="button" class="btn btn-danger" id="eliminar-foto-btn" style="display: none; width:100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
                                        <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414l-3.879-3.879zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z"/>
                                    </svg>
                                </button>
                            </div>

                            <input type="file" class="form-control-file" id="foto_entrega" name="foto_entrega" accept="image/*">

                            <div id="preview-foto" class="mt-2" style="display: none;">
                                <img id="preview-img" src="#" alt="Foto de entrega" style="max-width: 200px;">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="encargado">Colaborador que recibe de IT</label>
                            <input type="text" class="form-control" id="encargado" name="encargado" value="{{ auth()->user()->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="encargado">Persona que devuleve: </label>
                            <input type="text" class="form-control" id="encargado_devuelve" name="encargado" >
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

                        <p>NOTA:</p>
                        <div class="form-floating">
                            <textarea name="nota" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Observacion acerca de la devolución del equipo</label>
                          </div>

                        <button id="btn-finalizar" class="btn btn-success" type="button" onclick="guardarFirma()">Finalizar entrega</button>

                    </form>





                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        var tomarFotoBtn = document.getElementById("tomar-foto-btn");
var eliminarFotoBtn = document.getElementById("eliminar-foto-btn");
var fotoEntregaInput = document.getElementById("foto_entrega");
var previewFoto = document.getElementById("preview-foto");
var previewImg = document.getElementById("preview-img");
var crearEntregaBtn = document.getElementById("crear-entrega-btn");
var indicadorCreacion = document.getElementById("indicador-creacion");

tomarFotoBtn.addEventListener("click", function() {
    fotoEntregaInput.click();
});

fotoEntregaInput.addEventListener("change", function() {
    var file = this.files[0];

    if (file && file.type.startsWith("image/")) {
        var reader = new FileReader();
        reader.onload = function(event) {
            previewImg.src = event.target.result;
            previewFoto.style.display = "block";
            eliminarFotoBtn.style.display = "block";
            crearEntregaBtn.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
});

eliminarFotoBtn.addEventListener("click", function() {
    fotoEntregaInput.value = "";
    previewImg.src = "#";
    previewFoto.style.display = "none";
    eliminarFotoBtn.style.display = "none";
    crearEntregaBtn.style.display = "none";
});
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/4.1.5/signature_pad.umd.min.js"
    integrity="sha512-ngaalT22GGVs6hGMprLZ39ulFSdC/WUty7LR5AaFxpkDp5TUQ/w11WOIvZBktWOP/e9aA9m/xxpBUNDWpadROA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
    function pararDibujar() {
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
    // BORRAR FIRMA
    //======================================================================
    // Obtener referencia al botón de borrar
    let botonBorrar = document.getElementById('borrar');

    // Agregar un evento click al botón
    botonBorrar.addEventListener('click', function () {
        // Obtener el contexto del canvas
        let ctx = miCanvas.getContext('2d');
        // Borrar todo el contenido del canvas
        ctx.clearRect(0 , 0, miCanvas.width, miCanvas.height);
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

  // Mostrar el modal
  const modalEntrega = new bootstrap.Modal(document.getElementById('modalEntrega'));
  modalEntrega.show();

  // Evitar el envío del formulario
  return false;
}


    //****************************************************************************
    // ...

  // Obtén una referencia al botón "Finalizar entrega"
  const btnFinalizar = document.getElementById('btn-finalizar');



</script>
@endsection
