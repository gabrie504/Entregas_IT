@extends('plantilla')

@section('title')
    Editar Empleado
@endsection

@section('content')
<a href="{{ secure_url('/empleados') }}"><-- Volver al Menú</a>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Departamento') }}</div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ secure_url('/empleados/departamentos/' . $id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">{{ __('Nombre') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $departments->name) }}" required autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>






                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Actualizar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
