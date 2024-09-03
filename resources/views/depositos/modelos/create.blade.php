@extends('layout/template')

@section('title','Modelos | Crear')
@section('contenido')

<!-- Mensajes y Notificaciones -->
@if ($errors->any())
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <strong>¡Uy!</strong> Revisa los siguientes errores antes de continuar.
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Titulo de la Sección -->
<div class="d-flex">    
    <h2><i class="fa-solid fa-plus m-2"></i>Agregar Modelo de Equipo.</h2>
</div>

<!--Contenido de la Sección -->
<form action="{{ url('depositos/modelos') }}" method="post">
    @csrf
    <div>
        <label for="nombre" class="col-sm-2 col-form-label">Nombre de Modelo:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
        </div>
    </div>

    <div>
        <label for="marca_id" class="col-sm-2 col-form-label">Marca:</label>
        <div class="col-sm-5">
            <select name="marca_id" id="marca_id" class="form-select">
                <option value="{{ old('marca_id') }}">{{ old('marca_id') }}</option>
                @foreach($marcas as $marca)
                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between col-5">
        <a href="{{ url('depositos/')}}" class="btn btn-outline-danger btn-sm">
            <span>
                <i class="fa-solid fa-delete-left m-2"></i>Regresar
            </span>
        </a>
        <button type="submit" class="btn btn-outline-success btn-sm">
            <span>
                <i class="fa-solid fa-plus m-2"></i>Agregar Modelo
            </span>
        </button>
    </div>                
</form>

@endsection