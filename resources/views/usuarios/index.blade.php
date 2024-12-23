@extends('layout/template')

@section('title','TelPri-Web | Usuarios')
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
    <h2><i class="fa-solid fa-person m-2"></i>Administrador de Usuarios.</h2>
</div>

<!-- Botón Agregar -->
<div class="d-flex mb-2">
    <a href="{{ route('usuarios.create') }}" class="btn btn-outline-success btn-sm me-2">
        <i class="fa-solid fa-person-circle-plus m-2"></i>Agregar Usuario
    </a>
</div>

<!-- Resumen de Usuarios -->
<div class="d-flex mb-2">
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>
            Total Usuarios:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalUsuarios }}</span>
        </button>
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableUsuario">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->email }}</td>
            <td>
                @if($usuario->roles->isNotEmpty())
                    {{ $usuario->roles->first()->name }}
                @else
                    Sin rol
                @endif
            </td>
            <td>
                <button class="btn btn-outline-light btn-sm historial-btn" data-id="{{ $usuario->id }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </button>
                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-person-circle-exclamation"></i>
                </a>
                <form action="{{ route('usuarios.destroy', $usuario->id) }}" id="form-eliminar-{{ $usuario->id }}" class="d-inline" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-person-circle-xmark"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal para el historial -->
<div class="modal fade" id="historialModal" tabindex="-1" aria-labelledby="historialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header admin-navbar text-white">
                <h5 class="modal-title" id="historialModalLabel">
                    <i class="fa-solid fa-clock-rotate-left me-2"></i>Historial de Usuario
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="historialContent"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        initializeDataTable('#datatableUsuario', {
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
        // Manejo del botón de historial
        $('.historial-btn').on('click', function() {
    var userId = $(this).data('id');
    $.ajax({
        url: "{{ route('usuarios.historial', ':id') }}".replace(':id', userId),
        type: 'GET',
        success: function(response) {
            var content = '<h4>' + response.usuario + '</h4>';
            content += '<ul class="list-group">';
            response.activities.forEach(function(activity) {
                content += '<li class="list-group-item">';
                content += '<strong>' + activity.description + '</strong> - ' + 
                        new Date(activity.created_at).toLocaleString() + '<br>';
                content += 'Modelo: ' + activity.subject_type + ' (ID: ' + activity.subject_id + ')<br>';
                if (activity.properties && activity.properties.attributes) {
                    content += 'Cambios: <br>';
                    for (var key in activity.properties.attributes) {
                        content += key + ': ' + activity.properties.attributes[key] + '<br>';
                    }
                }
                content += '</li>';
            });
            content += '</ul>';
            $('#historialContent').html(content);
            $('#historialModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar el historial:", error);
            alert('Error al cargar el historial: ' + error);
        }
    });
});
    });
</script>
@endpush