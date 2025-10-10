@extends('layout.template')
@section('title','Pares | Detalles del Par')
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
        <i class="fa-solid fa-list-ul m-2"></i>Detalles del Par {{ $par->numero }}
    </h2>    
</div>

<!--Contenido de la Sección -->
<div>
    <label for="numero" class="col-sm-2 col-form-label fw-bold">Número:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $par->numero }}</p>
    </div>
</div>

<div>
    <label for="numero" class="col-sm-2 col-form-label fw-bold">Ubicación:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $par->ubicacion->nombre }}</p>
    </div>
</div>

@if(!empty($par->estado))
<div>
    <label for="estado" class="col-sm-2 col-form-label fw-bold">Estado:</label>
    <div class="col-sm-7 px-4">
        @if ($par->estado == 'Certificado')
            <p>{{ $par->estado }}<i class="fa-solid fa-certificate text-warning ms-2"></i></p>
        @elseif ($par->estado == 'Disponible')
            <p>{{ $par->estado }}<i class="fa-solid fa-check text-success ms-2"></i></p>
        @elseif ($par->estado == 'Asignado')
            <p>{{ $par->estado }}<i class="fa-solid fa-link text-primary ms-2"></i></p>
        @elseif ($par->estado == 'Por Verificar')
            <p>{{ $par->estado }}<i class="fa-solid fa-clock text-info ms-2"></i></p>
        @elseif ($par->estado == 'Dañado')
            <p>{{ $par->estado }}<i class="fa-solid fa-triangle-exclamation text-danger ms-2"></i></p>
        @else
            <p>{{ $par->estado }}</p>
        @endif
    </div>
</div>
@endif

@if(!empty($par->plataforma))
<div>
    <label for="plataforma" class="col-sm-2 col-form-label fw-bold">Plataforma:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $par->plataforma }}</p>
    </div>
</div>
@endif

@if(!empty($par->observaciones))
<div>
    <label for="observaciones" class="col-sm-2 col-form-label fw-bold">Observaciones:</label>
    <div class="col-sm-7 px-4">
        <p>{{ $par->observaciones }}</p>
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

<a href="{{ url('pares') }}" class="btn btn-outline-danger btn-sm">
    <span>
        <i class="fa-solid fa-delete-left m-2"></i>Regresar
    </span>
</a>
@can('Editar Pares')
<a href="{{ url('pares/'.$par->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
    <span>
        <i class="fa-solid fa-ethernet m-2"></i>Modificar Par
    </span>
</a>
@endcan
<!--Boton Historial-->
<a href="#" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#historialModal">
    <i class="fa-solid fa-clock-rotate-left"></i>
    <span>Historial</span>
</a>

@can('Eliminar Pares')
<form action="{{ url('pares/'.$par->id)}}" id="form-eliminar-{{ $par->id }}" action="{{ route('pares.destroy', $par->id) }}" class="d-inline" method="post">
    @method("DELETE")
    @csrf
    <button type="submit" class="btn btn-outline-danger ">
        <i class="fa-solid fa-trash"></i>
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
                                                    @if($key === 'ubicacion_id' && isset($value))
                                                        {{ \App\Models\Ubicacion::find($value)->nombre ?? 'N/A' }}
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
                                                    @if($key === 'ubicacion_id' && isset($value))
                                                        {{ \App\Models\Ubicacion::find($value)->nombre ?? 'N/A' }}
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
                title: '¿Estás seguro de que quieres eliminar este par?',
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