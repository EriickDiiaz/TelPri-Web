@extends('layout.template')

@section('title','TelPri-Web | Lineas')
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
    <h2><i class="fa-solid fa-phone m-2"></i>Líneas Telefónicas.</h2>
</div>

<!-- Botones de Acción -->
<div class="d-flex justify-content-between mb-2">
    <div>
        @can('Crear Lineas')
        <a href="{{ route('lineas.create') }}" class="btn btn-outline-success btn-sm me-2">
            <i class="fa-solid fa-phone-volume m-2"></i>Agregar Línea
        </a>
        @endcan
        @can('Editar Lineas')
        <a href="{{ route('lineas.avanzada') }}" class="btn btn-outline-light btn-sm me-2">
            <i class="fa-solid fa-binoculars m-2"></i>Busqueda Avanzada
        </a>
        @endcan
    </div>
</div>

<!-- Resumen de Lineas -->
<div class="d-flex mb-2">
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>
            Axe: <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalAxe }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>
            Cisco: <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalCisco }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>
            Ericsson: <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalEricsson }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>
            Externo: <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalExterno }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>
            Total: <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalLineas }}</span>
        </button>
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableLineas">
    <thead>
        <tr>
            <th>Línea</th>
            <th>Plataforma</th>
            <th>Titular</th>
            <th>Inventario</th>
            <th>Mac/EQ/Li3</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
</table>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = initializeDataTable('#datatableLineas', {
        processing: true,
        serverSide: true,
        ajax: "{{ route('lineas.index') }}",
        columns: [
            {data: 'linea', name: 'linea'},
            {data: 'plataforma', name: 'plataforma'},
            {data: 'titular', name: 'titular'},
            {data: 'inventario', name: 'inventario'},
            {data: 'mac', name: 'mac'},
            {data: 'estado', name: 'estado'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    // SweetAlert2 for delete confirmation
    $('#datatableLineas').on('click', '.delete-linea', function() {
        var lineaId = $(this).data('id');
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
                    url: "{{ url('lineas') }}/" + lineaId,
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