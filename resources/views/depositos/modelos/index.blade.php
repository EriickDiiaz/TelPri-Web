@extends('layout/template')

@section('title','TelPri-Web | Modelos')
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
    <h2><i class="fa-solid fa-microchip m-2"></i>Administrador de Modelos.</h2>
</div>

<!-- Botones Agregar -->
<div class="d-flex justify-content-between mb-2">
    <div>
        <a href="{{ route('modelos.create') }}" class="btn btn-outline-success btn-sm me-2">
            <i class="fa-solid fa-plus m-2"></i>Agregar Modelo
        </a>
    </div>
    <div>
        <a href="{{ url('depositos/marcas/') }}" class="btn btn-outline-primary btn-sm">
            <i class="fa-solid fa-delete-left m-2"></i>
            <span>Volver a Marcas</span>
        </a>
    </div>
</div>

<!-- Resumen de Modelos -->
<div class="d-flex mb-2">
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>
            Total Modelos:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalModelos }}</span>
        </button>
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableModelos">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Equipos en Depósito</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($modelos as $modelo)
        <tr>
            <td>{{ $modelo->nombre }}</td>
            <td>{{ $modelo->marca->nombre }}</td>
            <td>{{ $modelo->depositos_count }}</td>
            <td>
                <a href="{{ route('modelos.edit', $modelo->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ route('modelos.destroy', $modelo->id) }}" id="form-eliminar-{{ $modelo->id }}" class="d-inline" method="POST">
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
        initializeDataTable('#datatableModelos', {
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