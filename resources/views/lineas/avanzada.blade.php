@extends('layout.template')

@section('title', 'TelPri-Web | Búsqueda Avanzada de Líneas')
@section('contenido')

<!-- Titulo de la Sección -->
<div class="d-flex">
    <h2><i class="fa-solid fa-binoculars m-2"></i>Búsqueda Avanzada de Líneas.</h2>
</div>

<!-- Formulario de Búsqueda Avanzada -->
<form id="searchForm" class="mb-4">
    <div class="row g-3">
        <div class="col-md-3">
            <label for="linea" class="form-label">Línea</label>
            <input type="text" class="form-control" id="linea" name="linea">
        </div>
        <div class="col-md-3">
            <label for="vip" class="form-label">VIP</label>
            <select class="form-select" id="vip" name="vip">
                <option value="">No</option>
                <option value="Presidente">Presidente</option>
                <option value="Vice Presidente">Vice Presidente</option>
                <option value="Gerente General">Gerente General</option>
                <option value="Asesor">Asesor</option>
                <option value="Asistente">Asistente</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="inventario" class="form-label">Inventario</label>
            <input type="text" class="form-control" id="inventario" name="inventario">
        </div>
        <div class="col-md-3">
            <label for="serial" class="form-label">Serial</label>
            <input type="text" class="form-control" id="serial" name="serial">
        </div>
        <div class="col-md-3">
            <label for="plataforma" class="form-label">Plataforma</label>
            <select name="plataforma" id="plataforma" class="form-select">
                <option value="">Cualquiera</option>
                <option value="Axe">Axe</option>
                <option value="Cisco">Cisco</option>
                <option value="Ericsson">Ericsson</option>
                <option value="Externo">Externo</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select">
            <option value="">Cualquiera</option>
                <option value="Disponible">Disponible</option>
                <option value="Asignada">Asignada</option>
                <option value="Bloqueada">Bloqueada</option>
                <option value="Por Verificar">Por Verificar</option>
                <option value="Por Eliminar">Por Eliminar</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="titular" class="form-label">Titular</label>
            <input type="text" class="form-control" id="titular" name="titular">
        </div>
        <div class="col-md-3">
            <label for="localidad_id" class="form-label">Localidad</label>
            <select class="form-select" id="localidad_id" name="localidad_id">
                <option value="">Seleccione</option>
                @foreach($localidades as $localidad)
                    <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="piso_id" class="form-label">Piso</label>
            <select class="form-select" id="piso_id" name="piso_id">
                <option value="">Seleccione</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="mac" class="form-label">Mac</label>
            <input type="text" class="form-control" id="mac" name="mac">
        </div>
        <div class="col-md-3">
            <label for="ubicacion_id" class="form-label">Ubicacón</label>
            <select class="form-select" id="ubicacion_id" name="ubicacion_id">
                <option value="">Seleccione</option>
                @foreach($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="par_id" class="form-label">Par</label>
            <select class="form-select" id="par_id" name="par_id">
                <option value="">Seleccione</option>
            </select>
        </div>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Buscar</button>
        <button type="reset" class="btn btn-secondary">Limpiar</button>
    </div>
</form>

<!-- Tabla de Resultados -->
<table class="table table-striped" id="datatableLineas">
    <thead>
        <tr>
            <th>Línea</th>
            <th>Inventario</th>
            <th>Serial</th>
            <th>Plataforma</th>
            <th>Estado</th>
            <th>Titular</th>
            <th>Localidad</th>
            <th>Piso</th>
            <th>Mac</th>
            <th>Ubicación</th>
            <th>Par</th>
        </tr>
    </thead>
</table>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#datatableLineas').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('lineas.avanzada') }}",
            type: 'GET',
            data: function(d) {
                d.linea = $('#linea').val();
                d.vip = $('#vip').val();
                d.inventario = $('#inventario').val();
                d.serial = $('#serial').val();
                d.plataforma = $('#plataforma').val();
                d.estado = $('#estado').val();
                d.titular = $('#titular').val();
                d.localidad_id = $('#localidad_id').val();
                d.piso_id = $('#piso_id').val();
                d.mac = $('#mac').val();
                d.ubicacion_id = $('#ubicacion_id').val();
                d.par_id = $('#par_id').val();
            }
        },
        columns: [
            {data: 'linea_with_vip', name: 'linea', orderable: true, searchable: true},
            {data: 'inventario', name: 'inventario'},
            {data: 'serial', name: 'serial'},
            {data: 'plataforma', name: 'plataforma'},
            {data: 'estado', name: 'estado'},
            {data: 'titular', name: 'titular'},
            {data: 'localidad.nombre', name: 'localidad.nombre'},
            {data: 'piso.nombre', name: 'piso.nombre'},
            {data: 'mac', name: 'mac'},
            {data: 'ubicacion.nombre', name: 'ubicacion.nombre'},
            {data: 'par.numero', name: 'par.numero'}
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
        }
    });

    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        table.draw();
    });

    $('#searchForm button[type="reset"]').on('click', function() {
        $('#searchForm')[0].reset();
        table.draw();
    });

    // Dependent select for localidad and piso
    $('#localidad_id').change(function() {
        var localidadId = $(this).val();
        if (localidadId) {
            $.ajax({
                url: '{{ route("getPisos") }}',
                type: 'GET',
                data: { localidad_id: localidadId },
                success: function(data) {
                    $('#piso_id').empty();
                    $('#piso_id').append('<option value="">Seleccione</option>');
                    $.each(data, function(key, value) {
                        $('#piso_id').append('<option value="' + value.id + '">' + value.nombre + '</option>');
                    });
                }
            });
        } else {
            $('#piso_id').empty();
            $('#piso_id').append('<option value="">Seleccione</option>');
        }
    });

    $('#ubicacion_id').change(function() {
        var ubicacionId = $(this).val();
        if (ubicacionId) {
            $.ajax({
                url: '{{ route("getPares") }}',
                type: 'GET',
                data: { ubicacion_id: ubicacionId },
                success: function(data) {
                    $('#par_id').empty();
                    $('#par_id').append('<option value="">Seleccione</option>');
                    $.each(data, function(key, value) {
                        $('#par_id').append('<option value="' + value.id + '">' + value.numero + '</option>');
                    });
                }
            });
        } else {
            $('#par_id').empty();
            $('#par_id').append('<option value="">Seleccione</option>');
        }
    });
});
</script>
@endpush