@extends('layout/template') 

@section('title','Ubicaciones | Modificar Ubicación')
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
    <h2><i class="fa-solid fa-pen-to-square m-2"></i>Modificar Ubicación.</h2>
</div>

<!--Contenido de la Sección -->
<form action="{{ url('ubicaciones/' .$ubicacion->id) }}" method="post">
    @method("PUT")
    @csrf

    <div class="mb-2">
        <label for="nombre" class="col-sm-4 col-form-label">Nombre de la ubicación:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $ubicacion->nombre }}" required>
        </div>
    </div>

    <div class="mb-2">
        <label for="descripcion" class="col-sm-2 col-form-label">Descripcion de la ubicación:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{ $ubicacion->descripcion }}" required>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between col-5">
        <a href="{{ url('ubicaciones') }}" class="btn btn-outline-danger btn-sm">
            <span>
                <i class="fa-solid fa-delete-left m-2"></i>Regresar
            </span>
        </a>
        @can('Editar Ubicaciones')
        <button type="submit" class="btn btn-outline-primary btn-sm">
            <span>
                <i class="fa-solid fa-check m-2"></i>Actualizar Ubicación
            </span>
        </button>
        @endcan
    </div>               
</form>

@endsection