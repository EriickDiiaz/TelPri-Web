@extends('layout/template')

@section('title','DC Hatillo | Modificar Línea')
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
    <h2><i class="fa-solid fa-database m-2"></i>Modificar Línea DC el Hatillo.</h2>
</div>

<!--Contenido de la Sección -->
<form action="{{ url('hatillo/' .$hatillo->id) }}" method="post">
    @method("PUT")
    @csrf

    <div>
        <label for="linea" class="col-form-label">Línea:</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="linea" id="linea" value="{{ $hatillo->linea }}" required>
        </div>
    </div>

    <div>
        <label for="estado" class="col-form-label">Estado:</label>
        <div class="col-sm-7">
            <select name="estado" id="estado" class="form-select">
                <option value="{{ $hatillo->estado }}">{{ $hatillo->estado }}</option>
                <option value="Disponible">Disponible</option>
                <option value="Asignada">Asignada</option>
            </select>
        </div>
    </div>

    <div>
        <label for="titular" class="col-form-label">Titular:</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="titular" id="titular" value="{{ $hatillo->titular }}">
        </div>
    </div>

    <div>
        <label for="inventario" class="col-form-label">Cod. Inventario:</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="inventario" id="inventario" value="{{ $hatillo->inventario }}">
        </div>
    </div>

    <div>
        <label for="serial" class="col-form-label">Serial:</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="serial" id="serial" value="{{ $hatillo->serial }}">
        </div>
    </div>

    <div>
        <label for="mac" class="col-form-label">Mac Address:</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="mac" id="mac" value="{{ $hatillo->mac }}">
        </div>
    </div>

    <div>
        <label for="piso" class="col-form-label">Piso:</label>
        <div class="col-sm-7">
            <select name="piso" id="piso" class="form-select">
                <option value="{{ $hatillo->piso }}">{{ $hatillo->piso }}</option>
                <option value="PB">PB</option>
                <option value="P1">P1</option>
                <option value="P2">P2</option>
            </select>
        </div>
    </div>

    <div>
        <div class="d-flex justify-content-between col-7">
            <div class="col-sm-5">
                <label for="ephone" class="col-form-label">e-Phone:</label>
                <input type="number" min="0" max="99" class="form-control" name="ephone" id="ephone" value="{{ $hatillo->ephone }}">
            </div>
            <div class="col-sm-5">
                <label for="dn" class="col-form-label">DN:</label>
                <input type="number" min="0" max="999" class="form-control" name="dn" id="dn" value="{{ $hatillo->dn }}">
            </div>
        </div>
    </div>

    <div>
        <label for="observacion" class="col-sm-2 col-form-label">Observaciones:</label>
        <div class="col-sm-7">
            <textarea class="form-control" name="observacion" id="observacion" cols="10" rows="10">{{ $hatillo->observacion }}</textarea>
        </div>
    </div>

    <div>
        <label for="modificado" class="col-sm-2 col-form-label">Modificado por:</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="modificado" id="modificado" value="{{ Auth::user()->name }}" readonly>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between col-sm-7">
        <a href="{{ url('hatillo') }}" class="btn btn-outline-danger btn-sm">
            <span>
                <i class="fa-solid fa-delete-left m-2"></i>Regresar
            </span>
        </a>
        <button type="submit" class="btn btn-outline-primary btn-sm">
            <span>
                <i class="fa-solid fa-user-pen m-2"></i>Actualizar Usuario
            </span>
        </button>
    </div>

</form>

@endsection