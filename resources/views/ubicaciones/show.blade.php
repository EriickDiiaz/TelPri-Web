@extends('layout.template')

@section('title','TelPri-Web | Ubicaciones')
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
    <h2><i class="fa-solid fa-diagram-project m-2"></i>Administrador de Ubicaciones.</h2>
</div>

<!-- Contenido de Sección -->
<div>
    <label for="nombre" class="col-sm-2 col-form-label fw-bold">Nombre de Ubicación:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $ubicacion->nombre }}</p>
    </div>
</div>

@if(!empty($ubicacion->descripcion))
<div>
    <label for="descripcion" class="col-sm-2 col-form-label fw-bold">Descripción:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $ubicacion->descripcion }}</p>
    </div>
</div>
@endif

<a href="{{ url('ubicaciones') }}" class="btn btn-outline-danger btn-sm">
    <span>
        <i class="fa-solid fa-delete-left m-2"></i>Regresar
    </span>
</a>
@can('Editar Ubicaciones')
<a href="{{ url('ubicaciones/'.$ubicacion->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
    <span>
        <i class="fa-solid fa-pen-to-square m-2"></i>Modificar Ubicación
    </span>
</a>
@endcan

<div class="d-flex mt-2">
    <h2><i class="fa-solid fa-phone m-2"></i>Líneas en esta Ubicación.</h2>
</div>

<div class="table-responsive mt-2">
    <table id="datatableLineas" class="table table-sm table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Línea</th>
                <th>Plataforma</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ubicacion->lineas as $linea)
            <tr>
                <td>{{ $linea->linea }}</td>
                <td>{{ $linea->plataforma ?? 'N/A' }}</td>
                <td>{{ $linea->estado ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('lineas.show', $linea->id) }}" class="btn btn-outline-light btn-sm">
                        <i class="fa-solid fa-list"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        initializeDataTable('#datatableLineas', {
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            responsive: true,
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