@extends('layout/template')

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
<div class="d-flex justify-content-between">
    <div>
        @can('Crear Lineas')
        <a href="{{ url('lineas/create') }}" class="btn btn-outline-success btn-sm me-2">
            <span>
                <i class="fa-solid fa-phone-volume m-2"></i>Agregar Línea
            </span>
        </a>
        @endcan
        <a href="{{ url('lineas/avanzada') }}" class="btn btn-outline-light btn-sm me-2">
            <span>
                <i class="fa-solid fa-binoculars m-2"></i>Busqueda Avanzada
            </span>
        </a>
    </div>
    <div>
        <form class="d-flex" role="search" action="{{ route('lineas.index') }}" method="get">
            <input class="form-control me-2" type="search" placeholder="Busqueda" aria-label="Search" name="busqueda" value="{{ $busqueda }}">
            <button class="btn btn-outline-success" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
    
</div>

<!-- Resumen de Lineas -->
<div class="d-flex py-2">
    <div class="align-items-center me-2">
        <button class="btn btn-outline-light btn-sm filter-button" data-plataforma="Axe">Axe:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalAxe }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn btn-outline-light btn-sm filter-button" data-plataforma="Cisco">Cisco:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalCisco }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn btn-outline-light btn-sm filter-button" data-plataforma="Ericsson">Ericsson:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalEricsson }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn btn-outline-light btn-sm filter-button" data-plataforma="Externo">Externo:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalExterno }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn btn-outline-primary btn-sm filter-button" data-plataforma="">Total:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalLineas }}</span>
        </button>        
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>Línea</th>
            <th>Plataforma</th>
            <th>Titular</th>
            <th>Inventario</th>
            <th>Mac/EQ/Li3</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if(count($lineas)<=0)
            <tr>
                <td colspan="7">                      
                    <div class="alert alert-warning d-flex align-items-center p-2" role="alert">
                        <i class="bi bi-exclamation-diamond align-middle"></i>
                        <div class="p-2">
                            ¡Uy! No hay nada que mostrar.
                        </div>
                    </div>
                </td>
            </tr>
        @else
        @foreach ($lineas as $linea)
        <tr>
            <td>{{ $linea->linea }}
                @if(!empty($linea->vip))
                <i class="bi bi-star text-warning"></i>
                @endif
            </td>
            <td>{{ $linea->plataforma }}</td>   
            <td>{{ $linea->titular }}</td>   
            <td>{{ $linea->inventario }}</td>
            <td>{{ $linea->mac }}</td>
            <td>{{ $linea->estado }}</td>
            <td>
                <!--Boton Detalles-->
                <a href="{{ url('lineas/'.$linea->id)}}" target="_blank" class="btn btn-outline-light btn-sm">
                    <i class="fa-solid fa-list-ul"></i>
                </a>
                <!--Boton Editar-->
                @can('Editar Lineas')
                <a href="{{ url('lineas/'.$linea->id.'/edit')}}" target="_blank" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-phone-volume"></i>
                </a>
                @endcan
                <!--Boton Eliminar-->
                @can('Eliminar Lineas')
                <form action="{{ url('lineas/'.$linea->id)}}" id="form-eliminar-{{ $linea->id }}" action="{{ route('lineas.destroy', $linea->id) }}" class="d-inline" method="post">
                    @method("DELETE")
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-phone-slash"></i>
                    </button>
                </form>
                @endcan
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="8">{{$lineas->appends(['busqueda'=>$busqueda])}}</td>
        </tr>
    </tfoot>
</table>

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