@extends('plantilla')

@section('title')
    Historial
@endsection

@section('content')

    <div class="container row flex-column row-cols-1 row-cols-md-2 g-4">
        <h1>Listado de Entregas</h1>  
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Entregó</th>
                    <th>Recibió</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{$centinela = null}}
                @foreach ($entregas as $entrega)
               
                    <tr>
                        @if ($entrega->id_entrega == $centinela)
                            @continue
                        @else
                        
                            <td>{{ $entrega->id_entrega }}</td>
                            <td>{{ $entrega->fecha_entrega }}</td>
                            <td>{{ $entrega->nombre_encargado }}</td>
                            <td>{{ $entrega->nombre_persona }}</td> 
                           
                                <td>
                                    <a href="{{ secure_url('/historialedit', $entrega->id_entrega) }}" class="btn btn-primary">Ver Detalles</a>
                                </td>
                            </tr>
                            
                            @php
                            $centinela = $entrega->id_entrega;
                            @endphp
                       
                        @endif
                    @endforeach
                </tbody>
            </table>
            {{ $entregas->onEachSide(0)->links() }}

            

        </div>
@endsection