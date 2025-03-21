@extends('layout/template')

@section('title','DC Hatillo | Ver Línea')
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
    <h2><i class="fa-solid fa-database m-2"></i>Detalles de Línea DataCenter El Hatillo.</h2>    
</div>

<!--Contenido de la Sección -->
<div class="mb-2">
    <label for="linea" class="col7 col-form-label fw-bold">Línea:</label>
    <div class="col-7 px-4">
        <p>{{ $hatillo->linea }}</p>
    </div>
</div>

@if(!empty($hatillo->estado))
<div class="mb-2">
    <label for="estado" class="col-7 col-form-label fw-bold">Estado:</label>
    <div class="col-7 px-4">
        <p>{{ $hatillo->estado }}</p>
    </div>
</div>
@endif

@if(!empty($hatillo->titular))
<div class="mb-2">
    <label for="titular" class="col-7 col-form-label fw-bold">Titular:</label>
    <div class="col-7 px-4">
        <p>{{ $hatillo->titular }}</p>
    </div>
</div>
@endif

@if(!empty($hatillo->inventario))
<div class="mb-2">
    <label for="inventario" class="col-7 col-form-label fw-bold">Cod. Inventario:</label>
    <div class="col-7 px-4">
        <p>{{ $hatillo->inventario }}</p>
    </div>
</div>
@endif

@if(!empty($hatillo->serial))
<div class="mb-2">
    <label for="serial" class="col-7 col-form-label fw-bold">Serial:</label>
    <div class="col-7 px-4">
        <p>{{ $hatillo->serial }}</p>
    </div>
</div>
@endif

@if(!empty($hatillo->mac))
<div class="mb-2">
    <label for="mac" class="col-7 col-form-label fw-bold">Mac Address:</label>
    <div class="col-7 px-4">
        <p>{{ $hatillo->mac }}</p>
    </div>
</div>
@endif

@if(!empty($hatillo->piso))
<div class="mb-2">
    <label for="piso" class="col-7 col-form-label fw-bold">Piso:</label>
    <div class="col-7 px-4">
        <p>{{ $hatillo->piso }}</p>
    </div>
</div>
@endif

@if(!empty($hatillo->ephone))
<div class="mb-2">
    <label for="ephone" class="col-7 col-form-label fw-bold">e-Phone:</label>
    <div class="col-7 px-4">
        <p>{{ $hatillo->ephone }}</p>
    </div>
</div>
@endif

@if(!empty($hatillo->dn))
<div class="mb-2">
    <label for="dn" class="col-7 col-form-label fw-bold">DN:</label>
    <div class="col-7 px-4">
        <p>{{ $hatillo->dn }}</p>
    </div>
</div>
@endif

@if(!empty($hatillo->observacion))
<div class="mb-2">
    <label for="oservacion" class="col-7 col-form-label fw-bold">Observaciones:</label>
    <div class="col-7 px-4">
        <p>{{ $hatillo->observacion }}</p>
    </div>
</div>
@endif

<div>
    <label for="modificado" class="col-sm-2 col-form-label fw-bold">Ultima modificación:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $hatillo->modificado }} {{ $hatillo->updated_at->format('d/m/Y H:i') }} </p>
    </div>
</div>


<a href="{{ url('hatillo') }}" class="btn btn-outline-danger btn-sm">
    <span>
        <i class="fa-solid fa-delete-left m-2"></i>Regresar
    </span>
</a>

<!--Boton Editar-->
@can('Editar Hatillo')
<a href="{{ url('hatillo/'.$hatillo->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
    <i class="fa-solid fa-pen-to-square m-2"></i>Modificar Línea
</a>
@endcan

<!--Boton Eliminar-->
@can('Eliminar Hatillo')
<form action="{{ url('hatillo/'.$hatillo->id)}}" id="form-eliminar-{{ $hatillo->id }}" class="d-inline" method="post">
    @method("DELETE")
    @csrf
    <button type="submit" class="btn btn-outline-danger">
        <i class="fa-solid fa-user-minus"></i>
    </button>
</form>
@endcan

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
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