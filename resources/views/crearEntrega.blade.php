@extends('plantilla')

@section('title')
    crear_entrega
@endsection

@section('content')

    <div class="container">


        @if($id == '1')
            <form method="POST" action="{{ secure_urlgm

            entrega') }}" enctype="multipart/form-data">
        @elseif( $id == 2)
            <form method="POST" action="{{ secure_url('/prestamo') }}" enctype="multipart/form-data">
        @elseif( $id == 3)
            <form method="POST" action="{{ secure_url('/entrega') }}" enctype="multipart/form-data">
        @endif
            @csrf

            <div class="form-group">
                <label for="fecha_entrega">Fecha</label>
                <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega">
            </div>

            <div class="form-group">
                <label for="hora_entrega">Hora</label>
                <input type="time" class="form-control" id="hora_entrega" name="hora_entrega">
            </div>

            <div class="form-group">
                <label for="encargado">Encargado</label>


                 <input type="text" class="form-control" id="encargado" name="encargado" value="{{ auth()->user()->name }}" readonly>
            </div>

            <br>

            <div class="form-group">
                <label for="foto_entrega">
                    @if($id == '1')
                        Foto Entrega
                    @elseif( $id == 2)
                        Foto de Prestamo
                    @elseif( $id == 3)
                        Foto de equipo que sale
                    @endif
                </label>
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

            <button type="submit" class="btn btn-primary" id="crear-entrega-btn" style="display: none; width: 100%;">
                Crear Entrega
            </button>

            <!-- Agrega el indicador de progreso aquí -->
            <div id="indicador-creacion" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                      <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
                <p class="text-center mt-2">Creando entrega...</p>
            </div>

        </form>
    </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

    // Obtener la fecha actual
    var fechaActual = new Date().toISOString().split("T")[0];

    // Establecer el valor del campo de fecha
    document.getElementById("fecha_entrega").value = fechaActual;

    // Modificar el evento submit del formulario
/*     var form = document.querySelector("form");
    form.addEventListener("submit", function() {
        indicadorCreacion.style.display = "block";  // Mostrar el indicador
        form.classList.add("disabled");  // Deshabilitar el formulario
    }); */
    $(document).ready(function() {
    $('form').submit(function() {
        $('#indicador-creacion').css('display', 'block');
        $(this).addClass('disabled');
    });
});

</script>
@endsection
