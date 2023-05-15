@extends('plantilla')

@section('cabecera')

@endsection

@section('title')
    Lista Articulos 
@endsection

@section('content')
    <div class="container">

        <h1>lista de articulos</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)
                    <tr>
                        <td>{{$articulo->id_articulo}}</td>
                        <td>{{$articulo->nombre_articulo}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $articulos->onEachSide(0)->links() }}  
       {{-- {{ $articulos->links('equipos/paginacion')}} --}}
       

    </div>
@endsection