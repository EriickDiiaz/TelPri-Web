@extends('layout/template')

@section('title','TelPri-Web | Marcas')
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
    <h2><i class="fa-solid fa-warehouse m-2"></i>Administrador de Marcas.</h2>
</div>

<!-- Botón Agregar -->
<a href="{{ url('depositos/marcas/create') }}" class="btn btn-outline-success btn-sm me-2">
    <span>
        <i class="fa-solid fa-plus m-2"></i>Agregar Marca
    </span>
</a>
<a href="{{ url('depositos/modelos/create') }}" class="btn btn-outline-success btn-sm me-2">
    <span>
        <i class="fa-solid fa-plus m-2"></i>Agregar Modelo
    </span>
</a>

<!-- Resumen de Marcas -->
<div class="d-flex py-2 col-8">
    <div class="align-items-center">
        <button class="btn btn-outline-primary btn-sm" disabled>
            Total Marcas:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalMarca }}</span>
        </button>
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableLocalidad">
    <thead>
        <tr>
            <th>Marca</th>
            <th>Modelos</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($marcas as $marca)
        <tr>
            <td>{{ $marca->nombre }}</td>
            <td>{{ $marca->modelos_count }}</td>
            <td>
                <!--Boton Editar-->
                <a href="{{ url('depositos/marcas/'.$marca->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <!--Boton Eliminar-->
                <form action="{{ url('depositos/marcas/'.$marca->id)}}" id="form-eliminar-{{ $marca->id }}" action="{{ route('marcas.destroy', $marca->id) }}" class="d-inline" method="post">
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