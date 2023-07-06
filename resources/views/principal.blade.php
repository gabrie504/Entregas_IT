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




</style>
@endsection

@section('content')
<div class="row row-cols-1 row-cols-md-2 g-4">
   <a href="{{secure_url('/entrega1')}}">
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

  <a href="{{secure_url('/entrega1')}}">
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

  <a href="{{secure_url('/entrega1')}}">
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

  <a href="{{secure_url('/historial')}}">
    <div class="col">
      <div class="card card-custom">
        <img src="{{secure_asset('historial.jpg')}}" class="card-img-top img-custom" alt="...">
        <div class="card-body">
          <h5 class="card-title">Historial de entregas</h5>
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
</div>
@endsection
