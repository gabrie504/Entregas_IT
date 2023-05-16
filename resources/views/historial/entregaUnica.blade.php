@extends('plantilla')

@section('title')
    Entrega Unica
@endsection

@section('content')
<div class="container">
    <h2>DEPARTAMENTO DE IT</h2>
    <h6>COMPROBANTE DE ENTREGA DE EQUIPO/ACCESORIOS</h6>
    <hr>
    <p>Fecha: {{ $entrega->fecha_entrega }}</p>
    <p>Hora: {{ $entrega->hora_entrega }}</p>
    <hr>
    <fieldset>
        <legend><strong>Detalles de la entrega</strong></legend>
        <p>Foto del Artículo: <img src="{{ secure_asset('storage/'. $entrega->foto_articulo)}}" alt="Foto del Artículo"></p>
        
        <p>Descripción del Artículo: {{ $entrega->descripcion_articulo }}</p>
        <p>Nombre del Artículo: {{ $entrega->nombre_articulo }}</p>
    </fieldset>
    
    <p>Firma del Encargado: <img src="{{ secure_asset('storage/'.$entrega->firma_encargado) }}" alt="Firma del Encargado"></p>
    
    <p>Recibe: {{ $entrega->nombre_persona }}</p>
    <p>Entrega: {{ $entrega->nombre_encargado }}</p>
</div>
@endsection