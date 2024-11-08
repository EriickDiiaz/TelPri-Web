@extends('layout/template')

@section('title','Localidades | Detalles de Localidad')
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
    <h2><i class="fa-solid fa-location-dot m-2"></i>Detalles de {{ $localidad->nombre }}</h2>
</div>

<!-- Botones -->
<div class="d-flex justify-content-between mb-2">
    <div>
        <a href="{{ url('pisos/create') }}" class="btn btn-outline-success btn-sm me-2">
            <i class="fa-solid fa-plus m-2"></i>Agregar Piso
        </a>
    </div>    
</div>

<!--Contenido de la Sección -->
<table class="table table-striped" id="datatablePisos">
    <thead>
        <tr>
            <th>Pisos</th>
            <th>Líneas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pisos as $piso)
        <tr>
            <td>{{ $piso->nombre }}</td>
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
            columns: [
                { data: 'Pisos' },
                { data: 'Líneas', searchable: false },
                { data: 'Acciones', orderable: false, searchable: false }
            ],
            order: [[0, 'asc']]
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