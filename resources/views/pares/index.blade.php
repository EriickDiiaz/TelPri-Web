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
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ route('pares.avanzada') }}" class="btn btn-outline-light btn-sm me-2">
            <i class="fa-solid fa-binoculars m-2"></i>Busqueda Avanzada
        </a>
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
<table class="table table-sm table-striped" id="datatablePares"> 
    <thead>
        <tr>
            <th>Número</th>
            <th>Ubicación</th>
            <th>Plataforma</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
</table>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        initializeDataTable('#datatablePares', {
            processing: true,
            serverSide: true,
            ajax: "{{ route('pares.index') }}",
            columns: [
                {data: 'numero', name: 'numero'},
                {data: 'ubicacion', name: 'ubicaciones.nombre'},
                {data: 'plataforma', name: 'plataforma'},
                {data: 'estado', name: 'estado'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        // SweetAlert2 for delete confirmation
        $('#datatablePares').on('click', '.delete-par', function() {
            var parId = $(this).data('id');
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
                    $.ajax({
                        url: "{{ url('pares') }}/" + parId,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            Swal.fire(
                                
                                'Eliminado!',
                                response.mensaje,
                                'success'
                            );
                            table.ajax.reload();
                        }
                    });
                }
            });
        });
    });
</script>
@endpush