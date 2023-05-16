@extends('plantilla')

@section('title')
    Entrega Unica
@endsection

@section('content')
<div class="container">
    <h1>Detalles de la Entrega</h1>
    <p>ID: {{ $entrega->id_entrega }}</p>
    <p>Fecha de Entrega: {{ $entrega->fecha_entrega }}</p>
    <p>Hora de Entrega: {{ $entrega->hora_entrega }}</p>
    <p>Nombre del Encargado: {{ $entrega->nombre_encargado }}</p>
    <p>Foto del Artículo: <img src="{{ $entrega->foto_articulo }}" alt="Foto del Artículo"></p>
    <p>Descripción del Artículo: {{ $entrega->descripcion_articulo }}</p>
    <p>Nombre del Artículo: {{ $entrega->nombre_articulo }}</p>
    <p>Firma del Encargado: <img src="{{ $entrega->firma_encargado }}" alt="Firma del Encargado"></p>
    <p>Nombre de la Persona: {{ $entrega->nombre_persona }}</p>
</div>
@endsection