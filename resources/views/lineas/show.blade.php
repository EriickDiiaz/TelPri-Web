@extends('layout/template')

@section('title','Lineas | Detalles de Linea')

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
        <i class="fa-solid fa-list-ul m-2"></i>Detalles de Línea {{ $linea->linea }}
        @if(!empty($linea->vip))
            <i class="fa-regular fa-star text-warning"></i>
        @endif
    </h2>    
</div>

<!--Contenido de la Sección -->
<div>
    <label for="linea" class="col-sm-2 col-form-label fw-bold">Línea:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $linea->linea }}</p>
    </div>
</div>

@if(!empty($linea->plataforma))
<div>
    <label for="plataforma" class="col-sm-2 col-form-label fw-bold">Plataforma:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $linea->plataforma }}</p>
    </div>
</div>
@endif

@if(!empty($linea->estado))
<div>
    <label for="estado" class="col-sm-2 col-form-label fw-bold">Estado:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $linea->estado }}</p>
    </div>
</div>
@endif

@if(!empty($linea->titular))
<div>
    <label for="titular" class="col-sm-2 col-form-label fw-bold">Titular:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $linea->titular }}</p>
    </div>
</div>
@endif

@if(!empty($linea->localidad_id) || !empty($linea->piso_id))
<div>
    <label for="localidad_id" class="col-sm-2 col-form-label fw-bold">Localidad:</label>
    <div class="col-sm-7 px-4">
        <p>
            {{ $linea->localidad->nombre ?? 'N/A'}}
            @if(!empty($linea->localidad_id) && !empty($linea->piso_id)), @endif
            {{ $linea->piso->nombre ?? 'N/A'}}
        </p>
    </div>
</div>
@endif

@if(!empty($linea->inventario))
    <div>
        <label for="inventario" class="col-sm-2 col-form-label fw-bold">Cod. Inventario:</label>
        <div class="col-sm-7 px-4">
            <p>{{ $linea->inventario }}</p>
        </div>
    </div>
@endif

@if(!empty($linea->serial))
<div>
    <label for="serial" class="col-sm-2 col-form-label fw-bold">Serial:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $linea->serial }}</p>
    </div>
</div>
@endif

@if(!empty($linea->mac))
<div>
    <label for="mac" class="col-sm-2 col-form-label fw-bold">Mac/EQ/LI3:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $linea->mac }}</p>
    </div>
</div>
@endif

@if(!empty($linea->directo))
<div>
    <label for="directo" class="col-sm-2 col-form-label fw-bold">Directo:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $linea->directo }}</p>
    </div>
</div>
@endif

@if(!empty($linea->campo) || !empty($linea->par))
<div>
    <label for="campo" class="col-sm-2 col-form-label fw-bold">Ubic/Par/Campo:</label>
    <div class="col-sm-7 px-4">
        <p>
            {{ $linea->campo->nombre ?? 'N/A' }}
            @if(!empty($linea->campo) && !empty($linea->par)) /P/ @endif
            {{ $linea->par ?? 'N/A' }}
        </p>
    </div>
</div>
@endif

@if(!empty($linea->acceso))
<div>
    <label for="acceso" class="col-sm-2 col-form-label fw-bold">Acceso:</label>
    <div class="col-sm-7 px-4">
        <ul>
            @foreach ($linea->acceso as $acceso)
                <li>{{ $acceso }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

@if(!empty($linea->vip))
<div>
    <label for="vip" class="col-sm-2 col-form-label fw-bold">Vip:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $linea->vip }}</p>
    </div>
</div>
@endif

@if(!empty($linea->observacion))
<div>
    <label for="observacion" class="col-sm-2 col-form-label fw-bold">Observaciones:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $linea->observacion }}</p>
    </div>
</div>
@endif

@if (!empty($linea->modificado))
    <div>
        <label for="modificado" class="col-sm-2 col-form-label fw-bold">Ultima modificación:</label>
        <div class="col-sm-7 px-4">
            <p>{{ $linea->modificado }} {{ $linea->updated_at->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>
@endif


<a href="{{ url('lineas') }}" class="btn btn-outline-danger btn-sm">
    <span>
        <i class="fa-solid fa-delete-left m-2"></i>Regresar
    </span>
</a>

<a href="{{ url('lineas/'.$linea->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
    <span>
        <i class="fa-solid fa-phone-volume m-2"></i>Modificar Línea
    </span>
</a>

<!--Boton Historial-->
<a href="#" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#historialModal">
    <i class="fa-solid fa-clock-rotate-left"></i>
    <span>Historial</span>
</a>

@can('Eliminar Lineas')
<form action="{{ url('lineas/'.$linea->id)}}" id="form-eliminar-{{ $linea->id }}" action="{{ route('lineas.destroy', $linea->id) }}" class="d-inline" method="post">
    @method("DELETE")
    @csrf
    <button type="submit" class="btn btn-outline-danger ">
        <i class="fa-solid fa-phone-slash"></i>
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
                        No hay registros de historial para esta línea.
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
                                                    @if($key === 'localidad_id' && isset($value))
                                                        {{ \App\Models\Localidad::find($value)->nombre ?? 'N/A' }}
                                                    @elseif($key === 'piso_id' && isset($value))
                                                        {{ \App\Models\Piso::find($value)->nombre ?? 'N/A' }}
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
                                                    @if($key === 'localidad_id' && isset($value))
                                                        {{ \App\Models\Localidad::find($value)->nombre ?? 'N/A' }}
                                                    @elseif($key === 'piso_id' && isset($value))
                                                        {{ \App\Models\Piso::find($value)->nombre ?? 'N/A' }}
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