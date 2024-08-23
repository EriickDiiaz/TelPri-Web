@extends('layout/template')

@section('title','Roles | Modificar Rol')
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
    <h2><i class="fa-solid fa-pen-to-square m-2"></i>Asignar/Modificar Rol.</h2>
</div>

<!--Contenido de la Sección -->
<form action="{{ url('roles/' .$role->id) }}" method="post">
    @method("PUT")
    @csrf

    <div class="mb-2">
        <label for="name" class="col-sm-2 col-form-label">Nombre del Rol:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="name" id="name" value="{{ $role->name }}" required>
        </div>
    </div>

    <div class="mb-2">
        <label for="permisos" class="col-sm-2 col-form-label">Permisos:</label>
        <div class="col-sm-5">
            @foreach ($permisos as $permiso)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permisos[]" value="{{ $permiso->id }}" id="permiso{{ $permiso->id }}" {{ $role->hasPermissionTo($permiso) ? 'checked' : '' }}>
                    <label class="form-check-label" for="permiso{{ $permiso->id }}">
                        {{ $permiso->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between col-5">
        <a href="{{ url('roles') }}" class="btn btn-outline-danger btn-sm">
            <span>
                <i class="fa-solid fa-delete-left m-2"></i>Regresar
            </span>
        </a>
        <button type="submit" class="btn btn-outline-primary btn-sm">
            <span>
                <i class="fa-solid fa-check m-2"></i>Actualizar Rol
            </span>
        </button>
    </div>
</form>

@endsection