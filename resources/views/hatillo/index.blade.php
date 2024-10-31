@extends('layout/template') 

@section('title','TelPri-Web | DC El Hatillo')
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
    <h2><i class="fa-solid fa-database m-2"></i>DataCenter El Hatillo.</h2>
</div>

<!-- Botones Agregar --> 
 @can('Crear Hatillo')  
<div class="d-flex mb-2">
    <a href="{{ url('hatillo/create') }}" class="btn btn-outline-success btn-sm">
        <i class="fa-solid fa-database m-2"></i>
        <span>Agregar Línea</span>
    </a>    
</div>
@endcan

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableHatillo">
    <thead>
        <tr>
            <th>Línea</th>
            <th>Titular</th>
            <th>Cod. Inv.</th>
            <th>Mac Address</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($hatillo as $hatillo)
        <tr>
            <td>{{ $hatillo->linea }}</td>
            <td>{{ $hatillo->titular }}</td>   
            <td>{{ $hatillo->inventario }}</td>   
            <td>{{ $hatillo->mac }}</td>                        
            <td>{{ $hatillo->estado }}</td>   
            <td>
                <a href="#" class="btn btn-outline-light btn-sm">
                    <i class="fa-solid fa-list-ul"></i>
                </a>
                @can('Editar Hatillo')
                <a href="{{ url('hatillo/'.$hatillo->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-user-pen"></i>
                </a>
                @endcan
                @can('Eliminar Hatillo')
                <form action="{{ url('hatillo/'.$hatillo->id)}}" id="form-eliminar-{{ $hatillo->id }}" class="d-inline" method="post">
                    @method("DELETE")
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-user-minus"></i>
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
        initializeDataTable('#datatableHatillo', {
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