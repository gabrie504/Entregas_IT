@extends('plantilla')

@section('title')
    crear_entrega
@endsection

@section('content')
    <form method="POST" action="{{route('entrega.crear')}}">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Fecha</span>
            <input type="date" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="fecha_entrega">
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
          <button type="submit" class="btn btn-primary">Crear Entrega</button>
          <button type="submit" class="btn btn-primary">Crear Entrega</button>

          
    </form>
@endsection