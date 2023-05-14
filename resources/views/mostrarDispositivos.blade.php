@extends('plantilla')

@section('content')
  <div class="container">
    <h1>Agregar equipos</h1>
    <form action="{{ secure_url('/dispositivo') }}" method="POST">
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
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="lista-equipos"></tbody>
      </table>
    </div>

    <button type="submit" class="btn btn-success" id="enviar-equipos">Enviar equipos</button>
  </div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    var equipos = [];

    $('#agregar-equipo').click(function() {
      var nombre = $('#nombre').val();
      var descripcion = $('#descripcion').val();

      if (nombre && descripcion) {
        equipos.push({ nombre: nombre, descripcion: descripcion });
        mostrarEquipos();
        $('#nombre').val('');
        $('#descripcion').val('');
      }
    });

    $(document).on('click', '.eliminar-equipo', function() {
      var index = $(this).data('index');
      equipos.splice(index, 1);
      mostrarEquipos();
    });

    $('#enviar-equipos').click(function() {
      $.ajax({
        url: '{{ secure_url("/dispositivo") }}',
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: { equipos: equipos },
        success: function(response) {
          equipos = [];
          mostrarEquipos();
          window.location.href = '{{ secure_url("/firma") }}';
        },
        error: function(xhr, status, error) {
          console.log('Error al enviar equipos: ' + error);
        }
      });
    });

    function mostrarEquipos() {
      var html = '';
      for (var i = 0; i < equipos.length; i++) {
        html += '<tr>';
        html += '<td>' + equipos[i].nombre + '</td>';
        html += '<td>' + equipos[i].descripcion + '</td>';
        html += '<td><button type="button" class="btn btn-danger eliminar-equipo" data-index="' + i + '">Eliminar</button></td>';
        html += '</tr>';
      }
      $('#lista-equipos').html(html);
    }
  });
</script>
@endsection
