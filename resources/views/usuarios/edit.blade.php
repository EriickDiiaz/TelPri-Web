@extends('layout/template')

@section('title','Usuarios | Modificar Usuario')
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
    <h2><i class="fa-solid fa-person-circle-exclamation m-2"></i>Modificar Usuario.</h2>
</div>

<!--Contenido de la Sección -->
<form action="{{ url('usuarios/' .$usuario->id) }}" method="post">
    @method("PUT")
    @csrf

    <div class="mb-2">
        <label for="name" class="col-sm-2 col-form-label">Nombre y Apellido:</label>
        <div class="col-sm-5">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $usuario->name }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="mb-2">
        <label for="name" class="col-sm-2 col-form-label">Usuario:</label>
        <div class="col-sm-5">
            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuario->email }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    @can('Asignar Roles')
    <div class="mb-2">
        <label for="role" class="col-sm-2 col-form-label">Rol:</label>
        <div class="col-sm-5">
            <select name="role" id="roel" class="form-select">
                <option value="">Seleccione</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}" name="role[]" id="role{{ $role->id }}" {{ $usuario->hasAnyRole($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endcan
    <div class="mb-2">
        <label for="name" class="col-sm-2 col-form-label">Contraseña:</label>
        <div class="col-sm-5">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between col-5">
        <a href="{{ url('/usuarios') }}" class="btn btn-outline-danger btn-sm">
            <span>
                <i class="fa-solid fa-delete-left m-2"></i>Regresar
            </span>
        </a>
        <button type="submit" class="btn btn-outline-primary btn-sm">
            <span>
                <i class="fa-solid fa-person-circle-check m-2"></i>Actualizar Usuario
            </span>
        </button>
    </div>  
</form>

@endsection