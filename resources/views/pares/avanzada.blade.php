@extends('layout.template')
@section('title', 'TelPri-Web | Búsqueda Avanzada de Pares')
@section('contenido')

<!-- Titulo de la Sección -->
<div class="d-flex">
    <h2><i class="fa-solid fa-binoculars m-2"></i>Búsqueda Avanzada de Pares.</h2>
</div>

<!-- Formulario de Búsqueda Avanzada -->
<form id="searchForm" class="mb-4">
    <div class="row g-3">
        <div class="col-md-3">
            <label for="numero" class="form-label">Número</label>
            <input type="text" class="form-control" id="numero" name="numero">
        </div>
        <div class="col-md-3">
            <label for="ubicacion_id" class="form-label">Ubicación</label>
            <select class="form-select" id="ubicacion_id" name="ubicacion_id">
                <option value="">Seleccione</option>
                @foreach($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select">
            <option value="">Cualquiera</option>
                <option value="Disponible">Disponible</option>
                <option value="Asignado">Asignado</option>
                <option value="Certificado">Certificado</option>
                <option value="Por Verificar">Por Verificar</option>
                <option value="Dañado">Dañado</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="plataforma" class="form-label">Plataforma</label>
            <select name="plataforma" id="plataforma" class="form-select">
                <option value="">Cualquiera</option>
                <option value="Analógica">Analógica</option>
                <option value="Digital">Digital</option>
            </select>
        </div>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Buscar</button>
        <button type="reset" class="btn btn-secondary">Limpiar</button>
    </div>
</form>

<!-- Tabla de Resultados -->
<table class="table table-striped" id="datatablePares">
    <thead>
        <tr>
            <th>Par</th>
            <th>Ubicación</th>
            <th>Estado</th>
            <th>Plataforma</th>
        </tr>
    </thead>
</table>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#datatablePares').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('pares.avanzada') }}",
            type: 'GET',
            data: function(d) {
                d.numero = $('#numero').val();
                d.ubicacion_id = $('#ubicacion_id').val();
                d.estado = $('#estado').val();
                d.plataforma = $('#plataforma').val();
            }
        },
        columns: [
            {data: 'numero', name: 'numero', orderable: true, searchable: true},
            {data: 'ubicacion.nombre', name: 'ubicacion.nombre'},
            {data: 'estado', name: 'estado'},
            {data: 'plataforma', name: 'plataforma'},
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