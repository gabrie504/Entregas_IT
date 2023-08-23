@extends('plantilla')

@section('title')
    Menu Empleados
@endsection

@section ('content')

<h1>Modulo - Gestion de Empleados</h1>
<strong><hr></strong>
<a href="{{secure_url('/empleados/agregar')}}" class="d-flex" style="display: flex; align-items: center;">
    <img src="{{secure_asset('agregar.png')}}" style="width: 30px; height: auto; margin-right: 10px;">
    <p style="margin: 0;">Agregar Empleado</p>
</a>
<hr>
<a href="{{secure_url('/empleados/listaEmpleados')}}" class="d-flex" style="display: flex; align-items: center;">
    <img src="{{secure_asset('lista.png')}}" style="width: 30px; height: auto; margin-right: 10px;">
    <p style="margin: 0;">Ver Empleados</p>
</a>

<hr>
</a>

<a href="{{secure_url('/empleados/departamento')}}" class="d-flex" style="display: flex; align-items: center;">
    <img src="{{secure_asset('department.png')}}" style="width: 30px; height: auto; margin-right: 10px;">
    <p style="margin: 0;">Departamentos</p>
</a>
<hr>

@endsection