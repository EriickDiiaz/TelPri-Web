@extends('layout/template')

@section('title','TelPri-Web | Ubicaciones')
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
    <h2><i class="fa-solid fa-ethernet m-2"></i>Administrador de Pares.</h2>
</div>

<!-- Botón Agregar -->
<div class="d-flex mb-2"> 
    <a href="{{ route('ubicaciones.create') }}" class="btn btn-outline-success btn-sm me-2">
        <i class="fa-solid fa-plus m-2"></i>Agregar Ubicación
    </a>
</div>

<!-- Resumen de Campos -->
<div class="d-flex mb-2">
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>
            Total:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalUbicacion }}</span>
        </button>
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableUbicaciones">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Número de Líneas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ubicaciones as $ubicacion)
        <tr>
            <td>{{ $ubicacion->nombre }}</td>
            <td>{{ $ubicacion->descripcion }}</td>
            <td>{{ $ubicacion->lineas_count }}</td>
            <td>
                <a href="{{ route('ubicaciones.edit', $ubicacion->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ route('ubicaciones.destroy', $ubicacion->id) }}" id="form-eliminar-{{ $ubicacion->id }}" class="d-inline" method="POST">
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
        initializeDataTable('#datatableUbicaciones', {
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