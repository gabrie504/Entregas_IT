@extends('plantilla')


@section('title')
    firma
@endsection

@section('content')
<h1>Entrega del {{ $entrega->fecha_entrega }} a las {{ $entrega->hora_entrega }}</h1>

@foreach ($articulos as $articulo)
    <p>Artículo: {{ $articulo->nombre_articulo }}</p>
    <p>Descripción: {{ $articulo->descripcion }}</p>
@endforeach
@endsection