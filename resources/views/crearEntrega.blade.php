@extends('plantilla')

@section('title')
    crear_entrega
@endsection

@section('content')
    <div class="container">
        <form method="POST" action="{{ secure_url('/entrega') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="fecha_entrega">Fecha</label>
                <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
            </div>

            <div class="form-group">
                <label for="hora_entrega">Hora</label>
                <input type="time" class="form-control" id="hora_entrega" name="hora_entrega">
            </div>

            <div class="form-group">
                <label for="encargado">Encargado</label>
                <input type="text" class="form-control" id="encargado" name="encargado" value="{{ auth()->user()->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="foto_entrega">Foto de entrega</label>
                <div class="d-flex">
                    <button type="button" class="btn btn-primary mr-2" id="tomar-foto-btn">Tomar Foto</button>
                    <button type="button" class="btn btn-danger" id="eliminar-foto-btn" style="display: none;">Eliminar Foto</button>
                </div>

                <input type="file" class="form-control-file" id="foto_entrega" name="foto_entrega" accept="image/*">

                <div id="preview-foto" class="mt-2" style="display: none;">
                    <img id="preview-img" src="#" alt="Foto de entrega" style="max-width: 200px;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" id="crear-entrega-btn" style="display: none;">Crear Entrega</button>
        </form>
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
    </script>
@endsection
