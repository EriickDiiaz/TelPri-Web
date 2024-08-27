@extends('layout/template')

@section('title','Callcenters | Crear')
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
    <h2><i class="fa-solid fa-user-plus m-2"></i>Crear Usuario CallCenter.</h2>
</div>

<!--Contenido de la Sección -->
<form action="{{ url('callcenters') }}" method="post">
    @csrf

    <div class="mb-2">
        <label for="extension" class="col-sm-2 col-form-label">Extensión:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="extension" id="extension" value="{{ old('extension') }}" required>
        </div>
    </div>

    <div class="mb-2">
        <label for="nombres" class="col-sm-2 col-form-label">Nombre y Apellido:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="nombres" id="nombres" value="{{ old('nombres') }}">
        </div>
    </div>

    <div class="mb-2">
        <label for="usuario" class="col-sm-2 col-form-label">Usuario:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="usuario" id="usuario" value="{{ old('usuario') }}">
        </div>
    </div>

    <div class="mb-2">
        <label for="contrasena" class="col-sm-2 col-form-label">Contraseña:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="contrasena" id="contrasena" value="{{ old('contrasena') }}">
        </div>
    </div>

    <div class="mb-2">
        <label for="servicio" class="col-sm-2 col-form-label">Servicio:</label>
        <div class="col-sm-5">
            <select name="servicio" id="servicio" class="form-select">
                <option value="{{ old('servicio') }}">{{ old('servicio') }}</option>
                <option value="CIC">CIC</option>
                <option value="CSI">CSI</option>
                <option value="HCM">HCM</option>
                <option value="CeCom">CeCom</option>
                <option value="PROV">Provisioning</option>
                <option value="COR">COR</option>
            </select>
        </div>
    </div>

    <div class="mb-2">
        <label for="acceso" class="col-sm-2 col-form-label">Acceso:</label>
        <div class="col-sm-5">
        <select name="acceso" id="acceso" class="form-select">
                <option value="{{ old('acceso') }}">{{ old('acceso') }}</option>
                <option value="Agent">Agent</option>
                <option value="Agent/Superv">Agent/Superv</option>
                <option value="Agent/Superv/Report">Agent/Superv/Report</option>
            </select>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between col-5">
        <a href="{{ url('callcenters') }}" class="btn btn-outline-danger btn-sm">
            <span>
                <i class="fa-solid fa-delete-left m-2"></i>Regresar
            </span>
        </a>
        <button type="submit" class="btn btn-outline-success btn-sm">
            <span>
                <i class="fa-solid fa-user-plus m-2"></i>Agregar Usuario
            </span>
        </button>
    </div>

</form>

@endsection