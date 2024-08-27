@extends('layout/template')

@section('title','Localidades | Detalles de Localidad')
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
        <h2 class="align-middle"><i class="fa-solid fa-location-dot m-2"></i>Detalles de {{ $localidad->nombre }}
    </h2>
</div>

<!-- Botón Agregar -->
<a href="{{ url('pisos/create') }}" class="btn btn-outline-success btn-sm me-2">
    <span>
        <i class="fa-solid fa-plus m-2"></i>Agregar Piso
    </span>
</a>

<!--Contenido de la Sección -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>Pisos</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pisos as $piso)
        <tr>
            <td>{{ $piso->nombre }}</td>
            <td>
                <!--Boton Editar-->
                <a href="{{ url('pisos/'.$piso->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <!--Boton Eliminar-->
                <form action="{{ url('pisos/'.$piso->id)}}" id="form-eliminar-{{ $piso->id }}" action="{{ route('pisos.destroy', $piso->id) }}" class="d-inline" method="post">
                    @method("DELETE")
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@push('scripts')
    @include('partials.sweetalert')
@endpush