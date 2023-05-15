@extends('plantilla')
@section('cabecera')

<style>
  .ui-autocomplete {
    max-height: 200px;
    overflow-y: auto;
    overflow-x: hidden;
    z-index: 1000;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 5px;
  }

  .ui-menu-item {
    padding: 5px;
    cursor: pointer;
  }

  .ui-menu-item:hover {
    background-color: #f0f0f0;
  }
</style>

    
@endsection 
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

      <div id="indicador-creacion" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="text-center">
          <div class="spinner-border" role="status">
            <span class="visually-hidden"><strong>Cargando...</strong></span>
          </div>
        </div>
        <p class="text-center mt-2"><strong>Creando entrega...</strong></p>
      </div>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
  $(document).ready(function() {
    var equipos = [];

    //********************************************************************
    //AUTOCOMPLETADO
    //*******************************************************************
    $('#nombre').autocomplete({
  source: function(request, response) {
    $.ajax({
      url: '/dispositivos2', // Ruta a tu método en el controlador para obtener los artículos
      dataType: 'json',
      data: {
        term: request.term
      },
      success: function(data) {
        response(data);
      }
    });
  },
  minLength: 2, // Número mínimo de caracteres para iniciar la búsqueda
  select: function(event, ui) {
    // Al seleccionar un artículo del autocompletado, asignar su valor al campo de entrada "nombre"
    $(this).val(ui.item.value);
    return false;
  }
});


//*********************************************************************

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
      // Mostrar el indicador de carga
      $('#indicador-creacion').show();

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
        },
        complete: function() {
          // Ocultar el indicador de carga
          $('#indicador-creacion').hide();
        }
      });
    });

    function mostrarEquipos() {
      var html = '';
      for(var i = 0; i < equipos.length; i++) {
      html += '<tr>';
      html += '<td>' + equipos[i].nombre + '</td>';
      html += '<td>' + equipos[i].descripcion + '</td>';
      html += '<td><button type="button" class="btn btn-danger eliminar-equipo" data-index="' + i + '">Eliminar</button></td>';
      html += '</tr>';
}
$('#lista-equipos').html(html);
}
});

// Mostrar el indicador de carga al enviar el formulario
var form = document.querySelector("form");
form.addEventListener("submit", function() {
document.getElementById("indicador-creacion").style.display = "block";
form.classList.add("disabled");
});
</script>
@endsection