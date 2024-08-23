@extends('layout/template')

@section('title','TelPri-Web | Adm. de Roles')
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
    <h2><i class="fa-solid fa-address-card m-2"></i>Administración de Roles.</h2>
</div>

<!-- Botón Agregar -->
<div class="mb-2">    
    <a href="{{ url('roles/create') }}" class="btn btn-outline-success btn-sm me-2">
        <span>
            <i class="fa-solid fa-plus m-2"></i>Agregar Rol
        </span>
    </a>        
</div>

<!-- Contenido de Sección -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre de Rol</th>            
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
        <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
            <td>
                <a href="{{ url('roles/'.$role->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ url('roles/'.$role->id)}}" id="form-eliminar-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" class="d-inline" method="post">
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
    @include('partials.sweetalert')
@endpush

@endsection