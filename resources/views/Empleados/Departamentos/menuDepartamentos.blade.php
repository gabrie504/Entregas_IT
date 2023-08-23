@extends('plantilla')

@section('title')
    Menu Departamentos
@endsection

@section ('content')

<h1>Modulo - Gestion de Empleados -> Departamentos</h1>
<strong><hr></strong>
<a href="{{secure_url('/empleados/departamentos/agregar')}}" class="d-flex" style="display: flex; align-items: center;">
    <img src="{{secure_asset('agregar.png')}}" style="width: 30px; height: auto; margin-right: 10px;">
    <p style="margin: 0;">Agregar Deprtamento</p>
</a>
<hr>

</a>

<a href="{{secure_url('/empleados/listadepartamentos')}}" class="d-flex" style="display: flex; align-items: center;">
    <img src="{{secure_asset('department.png')}}" style="width: 30px; height: auto; margin-right: 10px;">
    <p style="margin: 0;">ver Departamentos</p>
</a>
<hr>

@endsection