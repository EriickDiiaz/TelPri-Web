@extends('layout/template')

@section('title','TelPri-Web | Marcas')
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
    <h2><i class="fa-solid fa-warehouse m-2"></i>Administrador de Marcas.</h2>
</div>

<!-- Botones Agregar -->

<div class="d-flex justify-content-between mb-2">
    @can('Agregar Marca-Modelo')
    <div>
        <a href="{{ route('marcas.create') }}" class="btn btn-outline-success btn-sm me-2">
            <i class="fa-solid fa-plus m-2"></i>Agregar Marca
        </a>
        <a href="{{ route('modelos.create') }}" class="btn btn-outline-success btn-sm me-2">
            <i class="fa-solid fa-plus m-2"></i>Agregar Modelo
        </a>
    </div>
    @endcan
    <div>
        <a href="{{ url('depositos/modelos/') }}" class="btn btn-outline-primary btn-sm">
            <i class="fa-solid fa-gears m-2"></i>
            <span>Ver Modelos</span>
        </a>
    </div>
</div>


<!-- Resumen de Marcas -->
<div class="d-flex mb-2">
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>
            Total Marcas:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalMarca }}</span>
        </button>
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableMarcas">
    <thead>
        <tr>
            <th>Marca</th>
            <th>Modelos</th>
            <th>Equipos en Depósito</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($marcas as $marca)
        <tr>
            <td>{{ $marca->nombre }}</td>
            <td>{{ $marca->modelos_count }}</td>
            <td>{{ $marca->depositos_count }}</td>
            <td>
                <a href="{{ route('marcas.show', $marca->id) }}" class="btn btn-outline-light btn-sm">
                    <i class="fa-solid fa-gears"></i>
                </a>
                @can('Editar Marca-Modelo')
                <a href="{{ route('marcas.edit', $marca->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                @endcan
                @can('Eliminar Marca-Modelo')
                <form action="{{ route('marcas.destroy', $marca->id) }}" id="form-eliminar-{{ $marca->id }}" class="d-inline" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </form>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        initializeDataTable('#datatableMarcas', {
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