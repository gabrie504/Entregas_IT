@extends('plantilla')

@section('title')
    Inicio
@endsection

@section('cabecera')

<style>
  .card-custom {
  height: 100%;
}

.img-custom {
  object-fit: cover;
  height: 200px; /* Ajusta este valor para controlar la altura de la imagen */
}


.calendario{
  margin-top: 10%;

}

/* Estilos para dimensiones de móvil */
@media (max-width: 767px) {
  .calendario {
    display: none;
  }
}

</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.min.js">
@endsection

@section('content')

<div class="row row-cols-1 row-cols-md-2 g-4">
   <a href="{{secure_url('/entrega1',['id' => 1])}}">
     <div class="col">
      <div class="card card-custom">
        <img src="{{secure_asset('entrgas.jpg')}}" class="card-img-top img-custom" alt="...">
        <div class="card-body">
          <h5 class="card-title">Entregas</h5>
          <p class="card-text">Agregue una nueva entrega</p>
        </div>
      </div>
    </div>
  </a>

  <a href="{{secure_url('/entrega1',['id' => 2])}}">
    <div class="col">
      <div class="card card-custom">
        <img src="{{secure_asset('prestamos.jpg')}}" class="card-img-top img-custom" alt="...">
        <div class="card-body">
          <h5 class="card-title">Prestamos</h5>
          <p class="card-text">Prestar un equipo</p>
        </div>
      </div>
    </div>
  </a>

  <a href="{{secure_url('/entrega1',['id' => 3])}}">
    <div class="col">
      <div class="card card-custom">
        <img src="{{secure_asset('salidas.jpeg')}}" class="card-img-top img-custom" alt="...">
        <div class="card-body">
          <h5 class="card-title">Salida de Equipos</h5>
          <p class="card-text">Envio de Equipos</p>
        </div>
      </div>
    </div>
  </a>

  <a href="{{secure_url('/historialeps')}}">
    <div class="col">
      <div class="card card-custom">
        <img src="{{secure_asset('historial.jpg')}}" class="card-img-top img-custom" alt="...">
        <div class="card-body">
          <h5 class="card-title">Historial EPS</h5>
          <p class="card-text">Informacion completa de entregas anteriores</p>
        </div>
      </div>
    </div>
  </a>

  <a href="{{secure_url('/listaequipo')}}">
    <div class="col">
      <div class="card card-custom">
        <img src="{{secure_asset('lista.jpg')}}" class="card-img-top img-custom" alt="...">
        <div class="card-body">
          <h5 class="card-title">Lista de Equipos</h5>
          <p class="card-text">Lista de equipos que se han entregado al menos una vez</p>
        </div>
      </div>
    </div>
  </a>


<a href="{{secure_url('/empleados')}}">
  <div class="col">
    <div class="card card-custom">
      <img src="{{secure_asset('empleados.jpg')}}" class="card-img-top img-custom" alt="...">
      <div class="card-body">
        <h5 class="card-title">Gestion de Empleados</h5>
        <p class="card-text">Modulo encargado de todas las operaciones referentes a Empleados</p>
      </div>
    </div>
  </div>
</a>
</div>
@endsection



@section('aside')
<aside class="calendario col-12 col-md-3 col-lg-3 custom-width" style="position: relative;">
  <div style="background-color: rgba(128, 128, 128, 0.2); border-radius: 10px; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
  <h3 style="font-weight: bold; text-align: center; color: #ADD8E8; margin: 10px;">Historico EPS</h3>
  <div style="margin: 10px;">
    <div id="calendar"></div>
  </div>

  <ul style="margin-top: 5px;">
    <li style="font-weight: bold; color: #FFC0CB;">Entregas</li>
    <li style="font-weight: bold; color: #90EE90;">Prestamos</li>
    <li  style="font-weight: bold; color: #ADD8E6;">Salidas</li>
  </ul>
</aside>


@endsection


@section('scripts')


<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      // Configura las opciones del calendario aquí
    
    });

    calendar.render();
  });
</script>
@endsection
