@extends('layout/template')

@section('title','TelPri-Web | Adm. de Permisos')
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
    <h2><i class="fa-solid fa-list-check m-2"></i>Administración de Permisos.</h2>
</div>

<!-- Botón Agregar -->
<div class="mb-2">    
    <a href="{{ url('permisos/create') }}" class="btn btn-outline-success btn-sm me-2">
        <span>
            <i class="fa-solid fa-plus m-2"></i>Agregar Permiso
        </span>
    </a>        
</div>     

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatablePermiso">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del Permiso</th>            
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($permisos as $permiso)
        <tr>
            <td>{{ $permiso->id }}</td>
            <td>{{ $permiso->name }}</td>
            <td>
                <a href="{{ url('permisos/'.$permiso->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ url('permisos/'.$permiso->id)}}" id="form-eliminar-{{ $permiso->id }}" action="{{ route('permisos.destroy', $permiso->id) }}" class="d-inline" method="post">
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
    @include('partials.datatablePermiso')
    @include('partials.sweetalert')
@endpush

@endsection