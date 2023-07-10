@extends('plantilla')

@section('title')
    Historico_eps
@endsection

@section('cabecera')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection

@section('content')

    <h1>Historial de todas las transacciones</h1>
    <h5>aqui puede ver el historial de todas las Entregas-Prestamos-Salidas de equipos</h5>

    <a  href="{{secure_url('/historial')}}" class="d-flex">
        <span class="material-symbols-outlined">
            local_shipping
        </span>
        <p>ENTREGAS</p>
        </a>
    
        <a href=""></a>


        <a  href="{{secure_url('/historial')}}" class="d-flex">
            <span class="material-symbols-outlined">
                shopping_cart_checkout
                </span>
            <p>Prestamos</p>
        </a>
        
            <a href=""></a>

        <a  href="{{secure_url('/historial')}}" class="d-flex">
            <span class="material-symbols-outlined">
                flight
                </span>
                <p>Salidas de equipos</p>
                </a>

                <a  href="{{secure_url('/calendario')}}" class="d-flex">
                    <span class="material-symbols-outlined">
                        calendar_month
                        </span>
                        <p>Ver en el Calendario</p>
                </a>
            
      <a href=""></a>
            



            
            






@endsection