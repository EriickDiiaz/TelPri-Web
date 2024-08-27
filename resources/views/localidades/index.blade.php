@extends('layout/template')

@section('title','TelPri-Web | Localidades')
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
    <h2 class="align-middle"><i class="fa-solid fa-location-dot m-2"></i>Administrador de Localidades.</h2>
</div>

<!-- Botón Agregar -->
<a href="{{ url('localidades/create') }}" class="btn btn-outline-success btn-sm me-2">
    <span>
        <i class="fa-solid fa-plus m-2"></i>Agregar Localidad
    </span>
</a>
<a href="{{ url('pisos/create') }}" class="btn btn-outline-success btn-sm me-2">
    <span>
        <i class="fa-solid fa-plus m-2"></i>Agregar Piso
    </span>
</a>

<!-- Resumen de Localidades -->
<div class="d-flex py-2 col-8">
    <div class="align-items-center">
        <button class="btn btn-outline-primary btn-sm" disabled>
            Total Localidades:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalLocalidad }}</span>
        </button>
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableLocalidad">
    <thead>
        <tr>
            <th>Localidad</th>
            <th>Pisos</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($localidades as $localidad)
        <tr>
            <td>{{ $localidad->nombre }}</td>
            <td>{{ $localidad->pisos_count }}</td>
            <td>
                <!--Boton Pisos-->
                <a href="#" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="">
                    <i class="fa-solid fa-elevator"></i>
                </a>
                <!--Boton Editar-->
                <a href="{{ url('localidades/'.$localidad->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <!--Boton Eliminar-->
                <form action="{{ url('localidades/'.$localidad->id)}}" id="form-eliminar-{{ $localidad->id }}" action="{{ route('localidades.destroy', $localidad->id) }}" class="d-inline" method="post">
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
    @include('partials.datatableLocalidad')
    @include('partials.sweetalert')
@endpush