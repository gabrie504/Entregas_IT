@extends('plantilla')
{{-- @section('cabecera')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection --}}


@section('content')
  <div class="container">
    <h1>Agregar equipos</h1>
    <form action="{{ route('dispositivos.store') }}" method="POST">
     
      <div class="form-group">
        <label for="nombre">Nombre del equipo:</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
      </div>
      <div class="form-group">
        <label for="descripcion">Descripción del equipo:</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion">
      </div>
      <button type="button" class="btn btn-primary" id="agregar-equipo">Agregar equipo</button>
    </form>
    <br>
    <h2>Equipos agregados:</h2>
    <ul id="lista-equipos"></ul>
    {{-- 
      <button type="button" class="btn btn-info" id="tomar-foto">Tomar foto</button>
  <div id="foto"></div>
      
      --}}
    <button type="button" class="btn btn-success" id="enviar-equipos">Enviar equipos</button>
  </div>
@endsection

@section('scripts')
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <script>
    $(document).ready(function() {
      var equipos = [];
        //******************************************************************************

        //****************************************************************************** /* $('meta[name="csrf-token"]').attr('content') */
    $('#agregar-equipo').click(function() {
     var nombre = $('#nombre').val();
     var descripcion = $('#descripcion').val();

  if (nombre && descripcion) {
    equipos.push({ nombre: nombre, descripcion: descripcion });
    mostrarEquipos();
    $('#nombre').val(''); // Limpiar campo de nombre
    $('#descripcion').val(''); // Limpiar campo de descripción
  }
});




      $(document).on('click', '.eliminar-equipo', function() {
        var index = $(this).data('index');
        equipos.splice(index, 1);
        mostrarEquipos();
      });

  
  
      $('#enviar-equipos').click(function() {
  $.ajax({
    url: '{{route("dispositivos.store")}}',
    type: 'POST',
    headers: {
      'X-CSRF-TOKEN':'{{ csrf_token() }}'
     
    },
    data: {equipos: equipos},
    success: function(response) {
      console.log(response.message);
      equipos = []; // Limpiar la matriz de equipos
      mostrarEquipos(); // Actualizar la vista
    },
    error: function(xhr, status, error) {
      console.log('Error al enviar equipos: ' + error);
    }
  });
});


      function mostrarEquipos() {
        var html = '';
        for (var i = 0; i < equipos.length; i++) {
          html += '<li>' + equipos[i].nombre + ' - ' + equipos[i].descripcion + ' <button type="button" class="btn btn-danger eliminar-equipo" data-index="' + i + '">Eliminar</button></li>';
        }
        $('#lista-equipos').html(html);
      }
    });



  </script>
@endsection

