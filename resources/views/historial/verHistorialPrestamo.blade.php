@extends('plantilla')

@section('title')
    Historial
@endsection

@section('content')

    <div class="container row flex-column row-cols-1 row-cols-md-2 g-4">
        <h1>Listado de Prestamos</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Entregó</th>
                    <th>Recibió</th>
                    <th>Nota de Entrega</th>
                    <th>Nota de Devolución</th>
                </tr>
            </thead>
            <tbody>
                {{$centinela = null}}
                @foreach ($prestamos as $prestamo)

                    <tr>
                        @if ($prestamo->id == $centinela)
                            @continue
                        @else

                            <td>{{ $prestamo->id }}</td>
                            <td>{{ $prestamo->fecha_entrega }}</td>
                            <td>{{ $prestamo->nombre_encargado }}</td>
                            <td>{{ $prestamo->nombre_persona }}</td>

                                <td>
                                    <a href="{{ secure_url('/historialeditprestamo', $prestamo->id) }}" class="btn btn-primary">Ver Detalles</a>
                                </td>



                            @if ($prestamo->estado_prestamo == 0)
                                <td>
                                    <a href="{{ secure_url('/cerrarprestamo', $prestamo->id) }}" class="btn btn-danger">Pendiente</a>
                                </td>
                            @else
                                <td>
                                    <a href="{{ secure_url('/historialeditprestamo', $prestamo->id) }}" class="btn btn-primary">Devuelto</a>
                                </td>
                            @endif

                            </tr>

                            @php
                            $centinela = $prestamo->id;
                            @endphp

                        @endif
                    @endforeach
                </tbody>
            </table>
            {{ $prestamos->onEachSide(0)->links() }}



        </div>
@endsection
