@extends('layout/template')

@section('title','TelPri-Web | Usuarios')
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
    <h2><i class="fa-solid fa-person m-2"></i>Administrador de Usuarios.</h2>
</div>

<!-- Botón Agregar -->
<a href="{{ url('usuarios/create') }}" class="btn btn-outline-success btn-sm me-2">
    <span><i class="fa-solid fa-person-circle-plus m-2"></i>Agregar Usuario</span>
</a>

<!-- Resumen de Usuarios -->
<div class="d-flex justify-content-between py-2 col-8">
    <div class="align-items-center">
        <button class="btn btn-outline-primary btn-sm" disabled>
            Total:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalUsuarios }}</span>
        </button>
    </div>
</div>

<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableUsuario">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->email }}</td>
            <td>
                @if($usuario->roles->isNotEmpty())
                    {{ $usuario->roles->first()->name }}
                @else
                    Sin rol
                @endif
            </td>
            <td>
                <a href="{{ url('usuarios/'.$usuario->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-person-circle-exclamation"></i>
                </a>
                <form action="{{ url('usuarios/'.$usuario->id)}}" id="form-eliminar-{{ $usuario->id }}" action="{{ route('usuarios.destroy', $usuario->id) }}" class="d-inline" method="post">
                    @method("DELETE")
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-person-circle-xmark"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@push('scripts')
    @include('partials.datatableUsuario')
    @include('partials.sweetalert')
@endpush

@endsection