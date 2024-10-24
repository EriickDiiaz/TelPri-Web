@extends('layout/template') 

@section('title','TelPri-Web | Depósitos')
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
    <h2><i class="fa-solid fa-warehouse m-2"></i>Administración de Depósitos.</h2>
</div>

<!-- Botones Agregar -->
@can('Agregar Equipos')
<div class="d-flex justify-content-between mb-2">
    <div>
        <a href="{{ route('depositos.create') }}" class="btn btn-outline-success btn-sm">
            <i class="fa-solid fa-plus m-2"></i>
            <span>Agregar Equipo</span>
        </a>
    </div>
    <div>
        <a href="{{ url('depositos/marcas/') }}" class="btn btn-outline-primary btn-sm">
            <i class="fa-solid fa-plus m-2"></i>
            <span>Adm. Marcas / Modelos</span>
        </a>
    </div>
</div>
@endcan

<!-- Resumen de Lineas -->
<div class="d-flex mb-2">
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>Cortijos:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalCortijos }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>Nea:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalNea }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn-gradient-outline" disabled>Total:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalDeposito }}</span>
        </button>        
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableDepositos">
    <thead>
        <tr>
            <th>Cod. Inv.</th>
            <th>Serial</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Ubicación</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($depositos as $deposito)
        <tr>
            <td>{{$deposito->inventario}}</td>
            <td>{{$deposito->serial}}</td>
            <td>{{$deposito->marca->nombre ?? 'N/A'}}</td>
            <td>{{$deposito->modelo->nombre ?? 'N/A'}}</td>
            <td>{{$deposito->ubicacion}}</td>
            <td>{{$deposito->estado}}</td>
            <td>
                <a href="{{ route('depositos.show', $deposito->id) }}" class="btn btn-outline-light btn-sm">
                    <i class="fa-solid fa-list-ul"></i>
                </a>
                @can('Editar Equipos')
                <a href="{{ route('depositos.edit', $deposito->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                @endcan
                @can('Eliminar Equipos')
                <form action="{{ route('depositos.destroy', $deposito->id) }}" id="form-eliminar-{{ $deposito->id }}" class="d-inline" method="POST">
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
        initializeDataTable('#datatableDepositos', {
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