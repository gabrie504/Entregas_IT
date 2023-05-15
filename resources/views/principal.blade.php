@extends('plantilla')

@section('title')
    Inicio
@endsection

@section('content')




<div class="row row-cols-1 row-cols-md-2 g-4">
   <a href="{{secure_url('/entrega1')}}">
    {{-- <a href="{{route('entrega.mostrar')}}"> --}}
     <div class="col">
      <div class="card">
        <img src="{{secure_asset('entrgas.jpg')}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Entregas</h5>
          <p class="card-text">Agregue una nueva entrega</p>
        </div>
      </div>
        </div>
    </a>

    <a href="{{secure_url('/historial')}}">
      <div class="col">
        <div class="card">
          <img src="{{secure_asset('historial.jpg')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Historial de entregas</h5>
            <p class="card-text">Informacion completa de entregas anteriores</p>
          </div>
        </div>
      </div>
    </a>


    <a href="{{secure_url('/listaequipo')}}">
      <div class="col">
        <div class="card">
          <img src="{{secure_asset('lista.jpg')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Lista de Equipos</h5>
            <p class="card-text">Lista de equipos que sehan entregado al menos una vez </p>
          </div>
        </div>
      </div>
    </a>



@endsection