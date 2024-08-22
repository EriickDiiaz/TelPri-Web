@extends('layout/template')

@section('title','TelPri-Web | Campos')
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
    <h2><i class="fa-solid fa-ethernet m-2"></i>Administrador de Campos.</h2>
</div>

<!-- Botón Agregar -->
<div class="d-flex"> 
    <a href="{{ url('campos/create') }}" class="btn btn-outline-success btn-sm me-2">
        <span>
            <i class="fa-solid fa-plus m-2"></i>Agregar Campo
        </span>
    </a>
</div>

<!-- Resumen de Campos -->
<div class="d-flex py-2 col-8">
    <div class="align-items-center">
        <button class="btn btn-outline-primary btn-sm" disabled>
            Total:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalCampo }}</span>
        </button>
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableCampos">
    <thead>
        <tr>
            <th>ID</th>
            <th>Campo</th>
            <th>Descripción</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($campos as $campo)
        <tr>
            <td>{{ $campo->id }}</td>
            <td>{{ $campo->nombre }}</td>
            <td>{{ $campo->descripcion}}</td>
            <td>
                <a href="{{ url('campos/'.$campo->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ url('campos/'.$campo->id)}}" id="form-eliminar-{{ $campo->id }}" action="{{ route('campos.destroy', $campo->id) }}" class="d-inline" method="post">
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

@push('scripts')
    @include('partials.datatableCampos')
    @include('partials.sweetalert')
@endpush

@endsection