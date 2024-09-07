@extends('layout/template')

@section('title','Depósitos | Agregar')
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
    <h2><i class="fa-solid fa-warehouse m-2"></i>Agregar Equipo a Depósito.</h2>
</div>

<!--Contenido de la Sección -->
<form action="{{ url('depositos') }}" method="post">
    @csrf

    <div class="mb-2">
        <label for="inventario" class="col-7 col-form-label">Código de Inventario:</label>
        <div class="col-7">
            <input type="text" class="form-control" name="inventario" id="inventario" value="{{ old('inventario') }}" required>
        </div>
    </div>

    <div class="mb-2">
        <label for="serial" class="col-7 col-form-label">Serial:</label>
        <div class="col-7">
            <input type="text" class="form-control" name="serial" id="serial" value="{{ old('serial') }}">
        </div>
    </div>

    <div class="mb-2">
        <div class="d-flex justify-content-between col-7">
            <div class="col-sm-5">
                <label for="marca_id" class="col-sm-2 col-form-label">Marca:</label>
                <select name="marca_id" id="marca_id" class="form-select">
                    <option value="{{ old('marca_id') }}">{{ old('marca_id') }}</option>
                        @foreach($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-sm-5">
                <label for="modelo_id" class="col-sm-2 col-form-label">Modelo:</label>
                <select name="modelo_id" id="modelo_id" class="form-select">
                    <option value="">Seleccione un Modelo</option>
                </select>
            </div>
        </div>
    </div>

    <div class="mb-2">
        <label for="ubicacion" class="col-7 col-form-label">Ubicación:</label>
        <div class="col-7">
            <select name="ubicacion" id="ubicacion" class="form-select">
                <option value="{{ old('ubicacion') }}">{{ old('ubicacion') }}</option>
                <option value="Cortijos">Cortijos</option>
                <option value="Nea">Nea</option>
            </select>
        </div>
    </div>

    <div class="mb-2">
        <label for="estado" class="col-7 col-form-label">Estado:</label>
        <div class="col-7">
        <select name="estado" id="estado" class="form-select">
                <option value="{{ old('estado') }}">{{ old('estado') }}</option>
                <option value="Deposito">Deposito</option>
                <option value="Instalado">Instalado</option>
                <option value="Por Desincorporar">Por Desincorporar</option>
                <option value="Por Reparar">Por Reparar</option>
                <option value="Desincorporado">Desincorporado</option>
            </select>
        </div>
    </div>

    <div class="mb-2">
        <label for="observacion" class="col-7 col-form-label">Observaciones:</label>
        <div class="col-7">
            <textarea class="form-control" name="observacion" id="observacion" cols="10" rows="3">{{ old('observacion') }}</textarea>
        </div>
    </div>

    <div class="mb-2">
        <label for="modificado" class="col-7 col-form-label">Creado por:</label>
        <div class="col-7">
            <input type="text" class="form-control" name="modificado" id="modificado" value="{{ Auth::user()->name }}" readonly>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between col-7">
        <a href="{{ url('depositos') }}" class="btn btn-outline-danger btn-sm">
            <span>
                <i class="fa-solid fa-delete-left m-2"></i>Regresar
            </span>
        </a>
        <button type="submit" class="btn btn-outline-success btn-sm">
            <span>
                <i class="fa-solid fa-user-plus m-2"></i>Agregar Equipo
            </span>
        </button>
    </div>

</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script para cargar los modelos segun la marca seleccionada-->
<script type="text/javascript">
$(document).ready(function() {
    $('#marca_id').change(function() {
        var marcaID = $(this).val();
        if(marcaID) {
            $.ajax({
                url: '{{ url("/get-modelos") }}/' + marcaID,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#modelo_id').empty();
                    $('#modelo_id').append('<option value="">Seleccione un modelo</option>');
                    $.each(data, function(key, value) {
                        $('#modelo_id').append('<option value="'+ value.id +'">'+ value.nombre +'</option>');
                    });
                }
            });
        } else {
            $('#modelo_id').empty();
            $('#modelo_id').append('<option value="">Seleccione un modelo</option>');
        }
    });
});
</script>

@endsection