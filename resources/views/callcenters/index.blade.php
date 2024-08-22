@extends('layout/template') 

@section('title','TelPri-Web | CallCenters')
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
    <h2><i class="fa-solid fa-headset m-2"></i>Usuarios CallCenter.</h2>
</div>

<!-- Botones Agregar -->   
<div class="d-flex mb-2">
    <a href="{{ url('callcenters/create') }}" class="btn btn-outline-success btn-sm">
        <i class="fa-solid fa-user-plus m-2"></i>
        <span>Agregar Usuario</span>
    </a>    
</div>

<!-- Resumen de Usuarios -->
<div class="d-flex mb-2">
    <div class="align-items-center me-2">
        <button class="btn btn-outline-light btn-sm" disabled>
            CIC:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalCIC }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn btn-outline-light btn-sm" disabled>
            CSI:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalCSI }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn btn-outline-light btn-sm" disabled>
            HCM:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalHCM }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn btn-outline-light btn-sm" disabled>
            CeCOM:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalCeCom }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn btn-outline-light btn-sm" disabled>
            PRO:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalPRO}}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn btn-outline-light btn-sm" disabled>
            COR:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalCOR }}</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn btn-outline-primary btn-sm" disabled>
            Total:
            <span class="badge text-bg-primary rounded-pill mx-2">{{ $totalCallcenter }}</span>
        </button>
    </div>
</div>
<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableCallcenter">
    <thead>
        <tr>
            <th>Extensión</th>
            <th>Nombres</th>
            <th>Usuario</th>
            <th>Pass</th>
            <th>Servicio</th>
            <th>Acceso</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($callcenters as $callcenter)
        <tr>
            <td>{{ $callcenter->extension }}</td>
            <td>{{ $callcenter->nombres }}</td>   
            <td>{{ $callcenter->usuario }}</td>   
            <td>{{ $callcenter->contrasena }}</td>                        
            <td>{{ $callcenter->servicio }}</td>   
            <td>{{ $callcenter->acceso }}</td>
            <td>
                <a href="{{ url('callcenters/'.$callcenter->id.'/edit')}}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-user-pen"></i>
                </a>
                @can('Eliminar Usuario CallCenter')
                <form action="{{ url('callcenters/'.$callcenter->id)}}" id="form-eliminar-{{ $callcenter->id }}" action="{{ route('callcenters.destroy', $callcenter->id) }}" class="d-inline" method="post">
                    @method("DELETE")
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-user-minus"></i>
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
    @include('partials.datatableCallcenter')
    @include('partials.sweetalert')
@endpush

