@extends('plantilla')

@section('title')
    Historial
@endsection

@section('content')

    <div class="container">
        <h1>Listado de Entregas</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha de Entrega</th>
                    <th>Encargado de Entregar</th>
                    <th>Recibio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entregas as $entrega)
                    <tr>
                        <td>{{ $entrega->id_entrega }}</td>
                        <td>{{ $entrega->fecha_entrega }}</td>
                        <td>{{ $entrega->nombre_encargado }}</td>
                        <td>{{ $entrega->nombre_persona }}</td> 
                            <td>
                                <a href="{{ secure_url('/historialedit', $entrega->id_entrega) }}" class="btn btn-primary">Ver Detalles</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $entregas->onEachSide(0)->links() }}

            

        </div>
@endsection