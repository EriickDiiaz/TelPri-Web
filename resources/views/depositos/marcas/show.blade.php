@extends('layout/template')

@section('title','Marcas | Detalles de Equipos')
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
        <h2 class="align-middle"><i class="fa-solid fa-gears m-2"></i>Detalles de equipos {{ $marca->nombre }}
    </h2>
</div>

<!-- Botón Agregar -->
 @can('Agregar Marca-Modelo')
<a href="{{ url('depositos/modelos/create') }}" class="btn btn-outline-success btn-sm me-2">
    <span>
        <i class="fa-solid fa-plus m-2"></i>Agregar Modelo
    </span>
</a>
@endcan

<!--Contenido de la Sección -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>Modelos</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($modelos as $modelo)
        <tr>
            <td>{{ $modelo->nombre }}</td>
            <td>
                <!--Boton Editar-->
                @can('Editar Marca-Modelo')
                <a href="{{ url('depositos/modelos/'.$modelo->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                @endcan
                <!--Boton Eliminar-->
                @can('Eliminar Marca-Modelo')
                <form action="{{ url('depositos/modelos/'.$modelo->id)}}" id="form-eliminar-{{ $modelo->id }}" action="{{ route('modelos.destroy', $modelo->id) }}" class="d-inline" method="post">
                    @method("DELETE")
                    @csrf
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
    @include('partials.sweetalert')
@endpush