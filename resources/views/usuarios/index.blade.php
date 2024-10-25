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
    });
</script>
@endpush