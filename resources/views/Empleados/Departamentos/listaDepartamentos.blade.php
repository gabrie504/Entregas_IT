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
    <h1>Listado de Departamentos</h1>  
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            {{$centinela = null}}
            @foreach ($departamentos as $departamento)
           
                <tr>
                    @if ($departamento->id == $centinela)
                        @continue
                    @else
                    
                        <td>{{ $departamento->id}} </td>
                        <td>{{ $departamento->name }}</td>
                        
                        
                            <td>
                                <a class="btn btn-info" href="{{secure_url('/empleados/departyamentos/editar', ['id' => $departamento->id])}}">E</a>
                                
                            </td>
                            <td>
                                <form action="{{secure_url('empleados/departamentos/eliminar' , ['id' => $departamento->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">X</button>
                                </form>
                            </td>
                        </tr>
                        
                        @php
                        $centinela = $departamento->id;
                        @endphp
                   
                    @endif
                @endforeach
            </tbody>
        </table>
        {{ $departamentos->onEachSide(0)->links() }}
    </div>



@endif
@endsection