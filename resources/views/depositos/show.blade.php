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
        <p>{{ $deposito->modificado }} {{ $deposito->updated_at->format('d/m/Y H:i:s') }}</p>
    </div>
</div>

<a href="{{ url('depositos') }}" class="btn btn-outline-danger btn-sm">
    <span>
        <i class="fa-solid fa-delete-left m-2"></i>Regresar
    </span>
</a>

<!--Boton Editar-->
@can('Editar Equipo Deposito')
<a href="{{ url('depositos/'.$deposito->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
    <i class="fa-solid fa-pen-to-square m-2"></i>Modificar Equipo
</a>
@endcan

<!--Boton Historial-->
<a href="#" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#historialModal">
    <i class="fa-solid fa-clock-rotate-left"></i>
    <span>Historial</span>
</a>

<!--Boton Eliminar-->
@can('Eliminar Equipo Deposito')
<form action="{{ url('depositos/'.$deposito->id)}}" id="form-eliminar-{{ $deposito->id }}" action="{{ route('depositos.destroy', $deposito->id) }}" class="d-inline" method="post">
    @method("DELETE")
    @csrf
    <button type="submit" class="btn btn-outline-danger btn-sm">
        <i class="fa-solid fa-xmark m-2"></i>
    </button>
</form>
@endcan

<!-- Modal -->
<div class="modal fade" id="historialModal" tabindex="-1" aria-labelledby="historialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header admin-navbar text-white">
                <h5 class="modal-title" id="historialModalLabel">
                    <i class="fa-solid fa-clock-rotate-left me-2"></i>Historial de Modificaciones
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($activities->isEmpty())
                    <div class="alert alert-warning">
                        No hay registros de historial para este equipo.
                    </div>
                @else
                    @foreach($activities as $activity)
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>
                                        @switch($activity->event)
                                            @case('created')
                                                <i class="fa-solid fa-plus text-success me-2"></i>Creación
                                                @break
                                            @case('updated')
                                                <i class="fa-solid fa-pen text-primary me-2"></i>Actualización
                                                @break
                                            @case('deleted')
                                                <i class="fa-solid fa-trash text-danger me-2"></i>Eliminación
                                                @break
                                            @default
                                                <i class="fa-solid fa-info text-info me-2"></i>Otro
                                        @endswitch
                                    </span>
                                    <small class="text-muted">
                                        <i class="fa-regular fa-clock me-1"></i>{{ $activity->created_at->format('d/m/Y H:i:s') }}
                                    </small>
                                </div>
                            </div>
                            <div class="card-body">
                                <p><strong>Modificado por:</strong> {{ $activity->causer ? $activity->causer->name : 'Sistema' }}</p>
                                @if($activity->properties->has('attributes'))
                                    <h5 class="mt-3"><u>Valores actuales:</u></h5>
                                    <ul class="list-unstyled">
                                        @foreach($activity->properties['attributes'] as $key => $value)
                                            @if($key !== 'updated_at' && $key !== 'created_at')
                                                <li>
                                                    <strong>{{ ucfirst($key) }}:</strong> 
                                                    @if($key === 'marca_id' && isset($value))
                                                        {{ \App\Models\Marca::find($value)->nombre ?? 'N/A' }}
                                                    @elseif($key === 'modelo_id' && isset($value))
                                                        {{ \App\Models\Modelo::find($value)->nombre ?? 'N/A' }}
                                                    @else
                                                        {{ is_array($value) ? json_encode($value) : $value }}
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                                @if($activity->properties->has('old'))
                                    <h5 class="mt-3"><u>Valores anteriores:</u></h5>
                                    <ul class="list-unstyled">
                                        @foreach($activity->properties['old'] as $key => $value)
                                            @if($key !== 'updated_at' && $key !== 'created_at')
                                                <li>
                                                    <strong>{{ ucfirst($key) }}:</strong> 
                                                    @if($key === 'marca_id' && isset($value))
                                                        {{ \App\Models\Marca::find($value)->nombre ?? 'N/A' }}
                                                    @elseif($key === 'modelo_id' && isset($value))
                                                        {{ \App\Models\Modelo::find($value)->nombre ?? 'N/A' }}
                                                    @else
                                                        {{ is_array($value) ? json_encode($value) : $value }}
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

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