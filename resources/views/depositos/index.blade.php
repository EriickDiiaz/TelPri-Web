@extends('layout/template') 

@section('title','TelPri-Web | Depósitos')
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
    <h2><i class="fa-solid fa-warehouse m-2"></i>Administración de Depósitos.</h2>
</div>

<!-- Botones Agregar -->   
<div class="d-flex mb-2">
    <a href="{{ url('depositos/create') }}" class="btn btn-outline-success btn-sm">
        <i class="fa-solid fa-plus m-2"></i>
        <span>Agregar Equipo</span>
    </a>    
</div>

<!-- Resumen de Usuarios -->
<div class="d-flex mb-2">
    <div class="align-items-center me-2">
        <button class="btn btn-outline-light btn-sm" disabled>
            Cortijos:
            <span class="badge text-bg-primary rounded-pill mx-2">00</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn btn-outline-light btn-sm" disabled>
            Nea:
            <span class="badge text-bg-primary rounded-pill mx-2">00</span>
        </button>
    </div>
    <div class="align-items-center me-2">
        <button class="btn btn-outline-primary btn-sm" disabled>
            Total:
            <span class="badge text-bg-primary rounded-pill mx-2">00</span>
        </button>
    </div>
</div>
<!-- Contenido de Sección -->
<table class="table table-striped" id="datatableDepositos">
    <thead>
        <tr>
            <th>Cod. Inv.</th>
            <th>Serial</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Ubicación</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>        
        <tr>
            <td>XxXxXxX</td>
            <td>XxXxXxX</td>   
            <td>XxXxXxX</td>   
            <td>XxXxXxX</td>                        
            <td>XxXxXxX</td>   
            <td>XxXxXxX</td>
            <td>
                <!--Boton Pisos-->
                <a href="#" class="btn btn-outline-light btn-sm">
                    <i class="fa-solid fa-elevator"></i>
                </a>
                <!--Boton Editar-->
                <a href="#" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <!--Boton Eliminar-->
                
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                
            </td>
        </tr>
    </tbody>
</table>

@endsection

@push('scripts')
    @include('partials.datatableDepositos')
    @include('partials.sweetalert')
@endpush

