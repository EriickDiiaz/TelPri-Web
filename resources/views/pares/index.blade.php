@extends('layout.template')

@section('title','TelPri-Web | Pares')
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
<div class="d-flex justify-content-between mb-2">
    <div>
        @can('Crear Pares')
        <a href="{{ route('pares.create') }}" class="btn btn-outline-success btn-sm me-2">
            <i class="fa-solid fa-plus m-2"></i>Agregar Par
        </a>
        @endcan
        @can('Crear Ubicaciones')
        <a href="{{ route('ubicaciones.create') }}" class="btn btn-outline-success btn-sm me-2">
            <i class="fa-solid fa-plus m-2"></i>Agregar Ubicación
        </a>
        @endcan
    </div>
    <div>
        <a href="{{ url('ubicaciones/') }}" class="btn btn-outline-primary btn-sm">
            <i class="fa-solid fa-diagram-project m-2"></i>
            <span>Ver Ubicaciones</span>
        </a>
    </div>
</div>

<!-- Resumen de Campos -->
<div class="d-flex mb-2">
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>
            Total:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $pares->count() }}</span>
        </button>
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-sm table-striped" id="datatableUbicaciones"> 
    <thead>
        <tr>
            <th>Número</th>
            <th>Ubicación</th>
            <th>Plataforma</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pares as $par)
        <tr>
            <td>{{ $par->numero }}</td>
            <td>{{ $par->ubicacion->nombre }}</td>
            <td>{{ $par->plataforma }}</td>
            <td>
                @if ($par->estado == 'Certificado')
                    <p>{{ $par->estado }}<i class="fa-solid fa-certificate text-warning ms-2"></i></p>
                @elseif ($par->estado == 'Disponible')
                    <p>{{ $par->estado }}<i class="fa-solid fa-check text-success ms-2"></i></p>
                @elseif ($par->estado == 'Asignado')
                    <p>{{ $par->estado }}<i class="fa-solid fa-link text-primary ms-2"></i></p>
                @elseif ($par->estado == 'Por Verificar')
                    <p>{{ $par->estado }}<i class="fa-solid fa-clock text-info ms-2"></i></p>
                @elseif ($par->estado == 'Dañado')
                    <p>{{ $par->estado }}<i class="fa-solid fa-triangle-exclamation text-danger ms-2"></i></p>
                @else
                    <p>{{ $par->estado }}</p>
                @endif
            </td>
            <td>
                <a href="{{ route('pares.show', $par->id) }}" class="btn btn-outline-light btn-sm">
                    <i class="fa-solid fa-list-ul"></i>
                </a>
                @can('Editar Pares')
                <a href="{{ route('pares.edit', $par->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                @endcan
                @can('Eliminar Pares')
                <form action="{{ route('pares.destroy', $par->id) }}" id="form-eliminar-{{ $par->id }}" class="d-inline" method="POST">
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