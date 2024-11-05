@extends('layout/template')

@section('title','Depositos | Equipo en Depósito')
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
    <h2>
        <i class="fa-solid fa-list-ul m-2"></i>Detalles de Equipo en Depósito
    </h2>    
</div>

<!--Contenido de la Sección -->
<div class="mb-2">
    <label for="inventario" class="col7 col-form-label fw-bold">Código de Inventario:</label>
    <div class="col-7 px-4">
        <p>{{ $deposito->inventario }}</p>
    </div>
</div>

@if(!empty($deposito->serial))
<div class="mb-2">
    <label for="serial" class="col-7 col-form-label fw-bold">Serial:</label>
    <div class="col-7 px-4">
        <p>{{ $deposito->serial }}</p>
    </div>
</div>
@endif

@if(!empty($deposito->marca_id) || !empty($deposito->modelo_id))
<div>
    <label for="marca_id" class="col7 col-form-label fw-bold">Marca/Modelo:</label>
    <div class="col-7 px-4">
        <p>
            {{ $deposito->marca->nombre ?? 'N/A'}}
            @if(!empty($deposito->marca_id) && !empty($deposito->modelo_id)), @endif
            {{ $deposito->modelo->nombre ?? 'N/A'}}
        </p>
    </div>
</div>
@endif

@if(!empty($deposito->ubicacion))
<div class="mb-2">
    <label for="ubicacion" class="col-7 col-form-label fw-bold">Ubicación:</label>
    <div class="col-7 px-4">
        <p>{{ $deposito->ubicacion }}</p>
    </div>
</div>
@endif

@if(!empty($deposito->estado))
<div class="mb-2">
    <label for="estado" class="col-7 col-form-label fw-bold">Estado:</label>
    <div class="col-7 px-4">
        <p>{{ $deposito->estado }}</p>
    </div>
</div>
@endif

@if(!empty($deposito->observacion))
<div class="mb-2">
    <label for="estado" class="col-7 col-form-label fw-bold">Observaciones:</label>
    <div class="col-7 px-4">
        <p>{{ $deposito->observacion }}</p>
    </div>
</div>
@endif

<div>
    <label for="modificado" class="col-sm-2 col-form-label fw-bold">Ultima modificación:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $deposito->modificado }} {{ $deposito->updated_at }}</p>
    </div>
</div>


<a href="{{ url('depositos') }}" class="btn btn-outline-danger btn-sm">
    <span>
        <i class="fa-solid fa-delete-left m-2"></i>Regresar
    </span>
</a>

<!--Boton Editar-->
@can('Editar Deposito')
<a href="{{ url('depositos/'.$deposito->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
    <i class="fa-solid fa-pen-to-square m-2"></i>Modificar Equipo
</a>
@endcan
<a href="#" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#historialModal">
    <i class="fa-solid fa-clock-rotate-left"></i>
    <span>Historial</span>
</a>

<!--Boton Eliminar-->
@can('Eliminar Deposito')
<form action="{{ url('depositos/'.$deposito->id)}}" id="form-eliminar-{{ $deposito->id }}" action="{{ route('depositos.destroy', $deposito->id) }}" class="d-inline" method="post">
    @method("DELETE")
    @csrf
    <button type="submit" class="btn btn-outline-danger btn-sm">
        <i class="fa-solid fa-xmark m-2"></i>
    </button>
</form>
@endcan

<script>
    document.querySelectorAll('form[id^="form-eliminar-"]').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formId = this.id;

            Swal.fire({
                title: '¿Estás seguro de que quieres eliminar esta línea?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                background: '#333',  // Fondo oscuro
                color: '#fff',       // Texto blanco
                customClass: {
                    popup: 'swal2-dark',
                    title: 'swal2-title',
                    confirmButton: 'swal2-confirm',
                    cancelButton: 'swal2-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        });
    });
</script>

@endsection