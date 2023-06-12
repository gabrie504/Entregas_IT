@extends('plantilla')

@section('title')
    Entrega Única
@endsection

@section('content')
<div class="container">
    <h2 class="text-center d-print-none">DEPARTAMENTO DE IT</h2>
    <h6 class="text-center d-print-none">COMPROBANTE DE ENTREGA DE EQUIPO/ACCESORIOS</h6>
    <hr class="d-print-none">
    <p class="text-center d-print-none">Fecha: {{ $fecha }}</p>
    <p class="text-center d-print-none">Hora: {{ $hora }}</p>
    <hr class="d-print-none">

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detalles de la entrega</h5>
                    <div class="row">
                        <div class="col-md-6 text-center"> <!-- Agregado "text-center" para centrar la imagen -->

                            <img src="{{ secure_asset('storage/'.$foto) }}" class="img-fluid img-thumbnail" alt="Foto del Artículo" style="max-width: 130px; margin: auto;"> <!-- Agregado "margin: auto;" para centrar la imagen -->

                          
                        </div>
                        <div class="col-md-6">
                            <table class="equipos-table  table table-light table-striped table table-responsive">
                                <thead>
                                    <tr>
                                        <th style="width: 30%;">Articulo</th>
                                        <th style="width: 70%;">Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($equipos as $equipo)
                                    <tr>
                                        <td>{{ $equipo->nombre_articulo }}</td>
                                        <td>{{ $equipo->descripcion_articulo }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center">
                        <p>Firma de quien Recibe:</p>
                        <img src="{{ secure_asset('storage/'.$firma) }}" class="img-fluid img-thumbnail" alt="Firma del Encargado" style="max-width: 150px;">
                    </div>
                    <p class="text-center">Recibio Por: {{ $recibe }}</p>
                    <p class="text-center">Entregado Por: {{ $encargado }}</p>

                    <div class="text-center d-print-none">
                        <button class="btn btn-primary" onclick="window.print()">Imprimir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @media print {
        .d-print-none {
            display: none !important;
        }
        body {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .container {
            max-width: 100%;
            margin: auto;
            padding: 0;
        }
        .card-body {
            padding: 10px;
        }
    }
</style>
@endpush