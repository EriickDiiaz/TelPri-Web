@extends('layout/template')

@section('title','TelPri-Web | Localidades')
@section('contenido')

<!-- Mensajes y Notificaciones -->
@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <i class="fa-solid fa-circle-check"></i>
        {{ Session::get('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Titulo de la Sección -->
<div class="d-flex">
    <h2 class="align-middle"><i class="fa-solid fa-location-dot m-2"></i>Administrador de Localidades.</h2>
</div>

<!-- Botones Agregar -->

<div class="d-flex justify-content-between mb-2">
    <div>
        <a href="{{ route('localidades.create') }}" class="btn btn-outline-success btn-sm me-2">
            <i class="fa-solid fa-plus m-2"></i>Agregar Localidad
        </a>
        <a href="{{ route('pisos.create') }}" class="btn btn-outline-success btn-sm me-2">
            <i class="fa-solid fa-plus m-2"></i>Agregar Piso
        </a>
    </div>
    <div>
        <a href="{{ url('pisos/') }}" class="btn btn-outline-primary btn-sm">
            <i class="fa-solid fa-elevator m-2"></i>
            <span>Ver Pisos</span>
        </a>
    </div>
</div>

<!-- Resumen de Localidades -->
<div class="d-flex mb-2">
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>
            Total Localidades:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalLocalidad }}</span>
        </button>
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableLocalidad">
    <thead>
        <tr>
            <th>Localidad</th>
            <th>Pisos</th>
            <th>Líneas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($localidades as $localidad)
        <tr>
            <td>{{ $localidad->nombre }}</td>
            <td>{{ $localidad->pisos_count }}</td>
            <td>{{ $localidad->lineas_count }}</td>
            <td>
                <a href="{{ route('localidades.show', $localidad->id) }}" class="btn btn-outline-light btn-sm">
                    <i class="fa-solid fa-elevator"></i>
                </a>
                <a href="{{ route('localidades.edit', $localidad->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ route('localidades.destroy', $localidad->id) }}" id="form-eliminar-{{ $localidad->id }}" class="d-inline" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        initializeDataTable('#datatableLocalidad', {
            // Add any specific options for this table
        });

        // SweetAlert2 for delete confirmation
        $(document).on('submit', 'form[id^="form-eliminar-"]', function(event) {
            event.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        });
    });
</script>
@endpush