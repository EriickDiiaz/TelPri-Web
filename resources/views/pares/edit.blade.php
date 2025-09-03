@extends('layout/template') 

@section('title','Pares | Modificar Par')
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
    <h2><i class="fa-solid fa-pen-to-square m-2"></i>Modificar Par.</h2>
</div>

<!--Contenido de la Sección -->
<form action="{{ url('pares/' .$par->id) }}" method="post">
    @method("PUT")
    @csrf

    <div class="mb-2">
        <label for="numero" class="col-sm-4 col-form-label">Número de Par:</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="numero" id="numero" value="{{ $par->numero }}" required>
        </div>
    </div>

    <div class="mb-2">
        <label for="ubicacion" class="col-sm-4 col-form-label">Ubicación del Par:</label>
        <div class="col-sm-5">
            <select class="form-select" name="ubicacion_id" id="ubicacion_id" required>
                <option value="{{ $par->ubicacion_id }}" selected>{{ $par->ubicacion_id }}</option>
                @foreach ($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id }}" {{ old('ubicacion') == $ubicacion->nombre ? 'selected' : '' }}>
                        {{ $ubicacion->nombre }}
                    </option>                   
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-2">
        <label for="plataforma" class="col-sm-4 col-form-label">Plataforma:</label>
        <div class="col-sm-5">
            <select class="form-select" name="plataforma" id="plataforma" required>
                <option value="{{ $par->plataforma }}" selected>{{ $par->plataforma }}</option>
                <option value="Analógica" {{ old('plataforma') == 'Analógica' ? 'selected' : '' }}>Analógica</option>
                <option value="Digital" {{ old('plataforma') == 'Digital' ? 'selected' : '' }}>Digital</option>
            </select>
        </div>
    </div>

    <div class="mb-2">
        <label for="estado" class="col-sm-4 col-form-label">Estado:</label>
        <div class="col-sm-5">
            <select class="form-select" name="estado" id="estado" required>
                <option value="{{ $par->estado }}" selected>{{ $par->estado }}</option>
                <option value="Disponible" {{ old('estado') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="Asignado" {{ old('estado') == 'Asignado' ? 'selected' : '' }}>Asignado</option>
                <option value="Certificado" {{ old('estado') == 'Certificado' ? 'selected' : '' }}>Certificado</option>
                <option value="Por Verificar" {{ old('estado') == 'Por Verificar' ? 'selected' : '' }}>Por Verificar</option>
                <option value="Dañado" {{ old('estado') == 'Dañado' ? 'selected' : '' }}>Dañado</option>
            </select>
        </div>
    </div>

    <div class="mb-2">
        <label for="observaciones" class="col-sm-4 col-form-label">Observaciones:</label>
        <div class="col-sm-5">
            <textarea class="form-control" name="observaciones" id="observaciones" rows="3">{{ $par->observaciones }}</textarea>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between col-5">
        <a href="{{ url('pares') }}" class="btn btn-outline-danger btn-sm">
            <span>
                <i class="fa-solid fa-delete-left m-2"></i>Regresar
            </span>
        </a>
        <button type="submit" class="btn btn-outline-primary btn-sm">
            <span>
                <i class="fa-solid fa-check m-2"></i>Actualizar Par
            </span>
        </button>
    </div>               
</form>

@endsection