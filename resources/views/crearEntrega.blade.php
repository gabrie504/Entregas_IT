@extends('plantilla')

@section('title')
    crear_entrega
@endsection

@section('content')
    {{-- <form method="POST" action="{{secure_url(route('entrega.crear'))}}"> --}}
        <form method="POST" action="{{secure_url('/entrega')}}" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Fecha</span>
            <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="fecha_entrega" id="fecha_entrega">
        </div>
        

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Hora</span>
            <input type="time" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="hora_entrega">
        </div>

        <select class="form-select" aria-label="Disabled select example" name="nombre_encargado">
            <option selected>Encargado de entrega</option>
            <option value="1">Kelvin</option>
            <option value="2">Jorge</option>
        </select>


        <div class="form-group">
            <label for="foto_entrega">Foto de entrega</label>
            <div>
                <button type="button" class="btn btn-primary" id="tomar-foto-btn">Tomar Foto</button>
            </div>
            
            <input type="file" class="form-control" id="foto_entrega" name="foto_entrega" accept="image/*" >

            <div id="preview-foto" style="display: none;">
                <img id="preview-img" src="#" alt="Foto de entrega" style="max-width: 200px;">
                <div>
                    <button type="button" class="btn btn-danger" id="eliminar-foto-btn">Eliminar Foto</button>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Crear Entrega</button                                           >

    </form>
@endsection

@section('scripts')
    <script>
        var tomarFotoBtn = document.getElementById("tomar-foto-btn");
        var fotoEntregaInput = document.getElementById("foto_entrega");
        var previewFoto = document.getElementById("preview-foto");
        var previewImg = document.getElementById("preview-img");
        var eliminarFotoBtn = document.getElementById("eliminar-foto-btn");

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
                };
                reader.readAsDataURL(file);
            }
        });

        eliminarFotoBtn.addEventListener("click", function() {
            fotoEntregaInput.value = "";
            previewImg.src = "#";
            previewFoto.style.display = "none";
        });



        // Obtener la fecha actual
        var fechaActual = new Date().toISOString().split('T')[0];

        // Establecer el valor del campo de fecha
        document.getElementById("fecha_entrega").value = fechaActual;

    </script>
@endsection