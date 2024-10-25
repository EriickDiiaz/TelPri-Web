@extends('layout/template')

@section('title','TelPri-Web | Pisos')
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
    <h2><i class="fa-solid fa-building m-2"></i>Administrador de Pisos.</h2>
</div>

<!-- Botones -->
<div class="d-flex justify-content-between mb-2">
    <div>
        <a href="{{ route('pisos.create') }}" class="btn btn-outline-success btn-sm">
            <i class="fa-solid fa-plus m-2"></i>Agregar Piso
        </a>
    </div>
    <div>
        <form class="d-flex" role="search" action="{{ route('pisos.index') }}" method="get">
            <select name="busqueda" id="busqueda" class="form-select me-2">
                <option value="">Seleccione localidad</option>
                @foreach($localidades as $localidad)
                <option value="{{ $localidad->id }}" {{ $busqueda == $localidad->id ? 'selected' : '' }}>
                    {{ $localidad->nombre }}
                </option>
                @endforeach
            </select>
            <button class="btn btn-outline-success btn-sm" type="submit">
                <i class="fa-solid fa-search"></i>
            </button>
        </form>
    </div>
    <div>
        <a href="{{ url('localidades/') }}" class="btn btn-outline-primary btn-sm">
            <i class="fa-solid fa-delete-left m-2"></i>
            <span>Volver a Localidades</span>
        </a>
    </div>
</div>

<!-- Resumen de Pisos -->
<div class="d-flex mb-2">
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>
            Total Pisos:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalPiso }}</span>
        </button>
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatablePisos">
    <thead>
        <tr>
            <th>Piso</th>            
            <th>Localidad</th>
            <th>Líneas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pisos as $piso)
        <tr>
            <td>{{ $piso->nombre }}</td>            
            <td>{{ $piso->localidad->nombre }}</td>
            <td>{{ $piso->lineas_count }}</td>
            <td>
                <a href="{{ route('pisos.edit', $piso->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ route('pisos.destroy', $piso->id) }}" id="form-eliminar-{{ $piso->id }}" class="d-inline" method="POST">
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
        initializeDataTable('#datatablePisos', {
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