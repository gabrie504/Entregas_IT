@extends('plantilla')

@section('title')
    Agregar Departamento
@endsection

@section('content')
<a href="{{secure_url('/empleados')}}"><--Menu</a>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Crear Empleado') }}</div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ secure_url('/empleados/departamentos/agregar') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Nombre Departamento') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                       <br>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Crear') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
