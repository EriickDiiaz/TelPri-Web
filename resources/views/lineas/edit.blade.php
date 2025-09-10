@extends('layout/template')

@section('title','Líneas | Modificar Línea')
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
    <h2><i class="fa-solid fa-phone-volume m-2"></i>Modificar Línea Telefónica.</h2>
</div>

<!--Contenido de la Sección -->
<form action="{{ url('lineas/' .$linea->id) }}" method="post">
    @method("PUT")
    @csrf

    <div>
        <label for="linea" class="col-sm-2 col-form-label">Línea:</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="linea" id="linea" value="{{ $linea->linea }}" required>
        </div>
    </div>

    <div>
        <label for="plataforma" class="col-sm-2 col-form-label">Plataforma:</label>
        <div class="col-sm-7">
            <select name="plataforma" id="plataforma" class="form-select">
                <option value="{{ $linea->plataforma }}">{{ $linea->plataforma }}</option>
                <option value="Axe">Axe</option>
                <option value="Cisco">Cisco</option>
                <option value="Ericsson">Ericsson</option>
                <option value="Externo">Externo</option>
            </select>
        </div>
    </div>

    <div>
        <label for="estado" class="col-sm-2 col-form-label">Estado:</label>
        <div class="col-sm-7">
        <select name="estado" id="estado" class="form-select">
                <option value="{{ $linea->estado }}">{{ $linea->estado }}</option>
                <option value="Disponible">Disponible</option>
                <option value="Asignada">Asignada</option>
                <option value="Bloqueada">Bloqueada</option>
                <option value="Por Verificar">Por Verificar</option>
                <option value="Por Eliminar">Por Eliminar</option>
            </select>
        </div>
    </div>

    <div>
        <label for="titular" class="col-sm-2 col-form-label">Titular:</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="titular" id="titular" value="{{ $linea->titular }}">
        </div>
    </div>

    <div class="d-flex justify-content-between col-7">
        <div class="col-sm-5">
            <label for="localidad_id" class="col-sm-2 col-form-label">Localidad:</label>
            <select name="localidad_id" id="localidad_id" class="form-select">
                <option value="">Seleccione una localidad</option>
                @foreach($localidades as $localidad)
                <option value="{{ $localidad->id }}" {{ $linea->localidad_id == $localidad->id ? 'selected' : '' }}>
                    {{ $localidad->nombre }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-5">
            <label for="piso_id" class="col-sm-2 col-form-label">Piso:</label>
            <select name="piso_id" id="piso_id" class="form-select">
                <option value="">Seleccione un piso</option>
                @foreach($pisos as $piso)
                <option value="{{ $piso->id }}" {{ $linea->piso_id == $piso->id ? 'selected' : '' }}>
                    {{ $piso->nombre }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    

    <div>
        <label for="inventario" class="col-sm-2 col-form-label">Cod. Inventario:</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="inventario" id="inventario" value="{{ $linea->inventario }}">
        </div>
    </div>

    <div>
        <label for="serial" class="col-sm-2 col-form-label">Serial:</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="serial" id="serial" value="{{ $linea->serial }}">
        </div>
    </div>

    <div>
        <label for="mac" class="col-sm-2 col-form-label">Mac/EQ/LI3:</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="mac" id="mac" value="{{ $linea->mac }}">
        </div>
    </div>

    <div>
        <label for="directo" class="col-sm-2 col-form-label">Directo:</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="directo" id="directo" value="{{ $linea->directo }}">
        </div>
    </div>

    <div class="d-flex justify-content-between col-7">
        <div class="col-sm-5">
            <label for="ubicacion_id" class="col-sm-2 col-form-label">Ubicación:</label>
            <select name="ubicacion_id" id="ubicacion_id" class="form-select">
                <option value="">Seleccione una ubicación</option>
                @foreach($ubicaciones as $ubicacion)
                <option value="{{ $ubicacion->id }}" {{ $linea->ubicacion_id == $ubicacion->id ? 'selected' : '' }}>
                    {{ $ubicacion->nombre }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-5">
            <label for="par_id" class="col-sm-2 col-form-label">Par:</label>
            <select name="par_id" id="par_id" class="form-select">
                <option value="">Seleccione un par</option>
                @foreach($pares as $par)
                <option value="{{ $par->id }}" {{ $linea->par_id == $par->id ? 'selected' : '' }}>
                    {{ $par->nombre }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    @php
        $accesos = ['Interno', 'Local', 'Nacional', '0416', 'Otras Operadoras', 'Internacional'];
    @endphp

    <div>
        <label for="acceso" class="col-sm-2 col-form-label">Accesos:</label>
        <div class="d-flex justify-content-between col-7">
            @foreach ($accesos as $acceso)  
                <div class="form-check me-2">
                    <input class="form-check-input" type="checkbox" name="acceso[]" value="{{ $acceso }}" id="acceso_{{ $acceso }}"
                    @if (in_array($acceso, old('acceso', $linea->acceso ?? []))) checked @endif>
                    <label class="form-check-label" for="acceso_{{ $acceso }}">
                        {{ $acceso }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div>
        <label for="vip" class="col-sm-2 col-form-label">¿VIP?</label>
        <div class="col-sm-7">
            <select name="vip" id="vip" class="form-select">
                <option value="{{ $linea->vip }}">{{ $linea->vip }}</option>
                <option value="">No</option>
                <option value="Presidente">Presidente</option>
                <option value="Vice Presidente">Vice Presidente</option>
                <option value="Gerente General">Gerente General</option>
                <option value="Asesor">Asesor</option>
                <option value="Asistente">Asistente</option>
            </select>
        </div>
    </div>

    <div>
        <label for="observacion" class="col-sm-2 col-form-label">Observaciones:</label>
        <div class="col-sm-7">
            <textarea class="form-control" name="observacion" id="observacion" cols="10" rows="5">{{ $linea->observacion }}</textarea>
        </div>
    </div>

    <div>
        <label for="modificado" class="col-sm-2 col-form-label">Modificado por:</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="modificado" id="modificado" value="{{ Auth::user()->name }}" readonly>
            </div>
    </div>

    <div class="mt-3 d-flex justify-content-between col-7">
        <a href="{{ url('lineas') }}" class="btn btn-outline-danger btn-sm">
            <span>
                <i class="fa-solid fa-delete-left m-2"></i>Regresar
            </span>
        </a>
        <button type="submit" class="btn btn-outline-primary btn-sm">
            <span>
                <i class="fa-solid fa-phone-volume m-2"></i>Actualizar Línea
            </span>
        </button>
    </div>

</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script type="text/javascript">
$(document).ready(function() {
    
    // Script para cargar los pisos segun la localidad seleccionada
    $('#localidad_id').change(function() {
        var localidadID = $(this).val();
        if(localidadID) {
            $.ajax({
                url: '{{ route("getPisos") }}',
                type: 'GET',
                data: { localidad_id: localidadID },
                dataType: 'json',
                success: function(data) {
                    $('#piso_id').empty();
                    $('#piso_id').append('<option value="">Seleccione un piso</option>');
                    $.each(data, function(key, value) {
                        $('#piso_id').append('<option value="'+ value.id +'">'+ value.nombre +'</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error en la petición AJAX:', error);
                }
            });
        } else {
            $('#piso_id').empty();
            $('#piso_id').append('<option value="">Seleccione un piso</option>');
        }
    });
    
    // Script para cargar los pares segun la ubicación seleccionada
    $('#ubicacion_id').change(function() {
        var ubicacionID = $(this).val();
        if(ubicacionID) {
            $.ajax({
                url: '{{ route("getPares") }}',
                type: 'GET',
                data: { ubicacion_id: ubicacionID },
                dataType: 'json',
                success: function(data) {
                    $('#par_id').empty();
                    $('#par_id').append('<option value="">Seleccione un par</option>');
                    $.each(data, function(key, value) {
                        $('#par_id').append('<option value="'+ value.id +'">'+ value.numero +'</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error en la petición AJAX:', error);
                }
            });
        } else {
            $('#par_id').empty();
            $('#par_id').append('<option value="">Seleccione un par</option>');
        }
    });

});
</script>

<!-- Script para marcar automaticamente checkboxes de accesos-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const accesos = ['Interno', 'Local', 'Nacional', '0416', 'Otras Operadoras', 'Internacional'];
        
        accesos.forEach((acceso, index) => {
            const checkbox = document.getElementById('acceso_' + acceso);
            checkbox.addEventListener('change', function () {
                if (this.checked) {
                    for (let i = 0; i < index; i++) {
                        document.getElementById('acceso_' + accesos[i]).checked = true;
                    }
                }
            });
        });
    });
</script>

@endsection