@extends('plantilla')

@section('title')
    lista de empleados
@endsection

@section('content')

<!-- resources/views/empleado.blade.php -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@else

<div class="container row flex-column row-cols-1 row-cols-md-2 g-4">
    <a href="{{secure_url('/empleados')}}"><--</a>
    <h1>Listado de Empleados</h1>  
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Departamento</th>
                <th>Detalles</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            {{$centinela = null}}
            @foreach ($empleados as $empleado)
           
                <tr>
                    @if ($empleado->id == $centinela)
                        @continue
                    @else
                    
                        <td>{{ $empleado->full_name}} </td>
                        <td>{{ $empleado->designation }}</td>
                        <td>{{ $empleado->name }}</td>
                        


                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    ver
                                </button>
                                    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Info Empleado</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">

                                <div class="mb-4">
                                    <strong>codigo: </strong> {{$empleado->id}} <br>
                                    <strong>Nombre: </strong> {{$empleado->full_name}}
                                    <strong>Email: </strong> {{$empleado->email}}
                                    <strong>Telefono: </strong> {{$empleado->phone}} <br>
                                    <strong>Cargo: </strong> {{$empleado->designation}}
                                    <strong>Departamento: </strong> {{$empleado->name}}
                                </div>

                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <a class="btn btn-primary" href="{{secure_url('/empleados/editar', ['id' => $empleado->id])}}">Editar</a>
        </div>
      </div>
    </div>
  </div>
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{secure_url('/empleados/editar', ['id' => $empleado->id])}}">E</a>
                                
                            </td>
                            <td>
                                <form action="{{secure_url('empleados/eliminar' , ['id' => $empleado->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">X</button>
                                </form>
                            </td>
                        </tr>
                        
                        @php
                        $centinela = $empleado->id;
                        @endphp
                   
                    @endif
                @endforeach
            </tbody>
        </table>
        {{ $empleados->onEachSide(0)->links() }}
    </div>



@endif
@endsection