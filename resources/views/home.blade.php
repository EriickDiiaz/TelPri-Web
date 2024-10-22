@extends('layout/template')

@section('title', 'Telpri-Web')
@section('contenido')

<!-- Mensajes y Notificaciones -->
@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ Session::get('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Titulo de la Sección -->
<div class="row justify-content-center mb-4">
    <div class="col-md-8 text-center">
        <h5 class="mb-3">Bienvenido, {{ Auth::user()->name }}</h5>
        <img src="{{ asset('imagenes/Logo_TelPriWeb_Wh.png') }}" alt="TelPri Logo" class="img-fluid" style="max-width: 150px;">
    </div>
</div>

<!-- Estilos para los elementos dentro de los acordeones -->
<style>
    .stat-card {
        border: 2px solid transparent;
        border-image: linear-gradient(to right, #7F24EE, #0098DA, #0E15F9) 1;
        background-color: transparent;
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .accordion-button:not(.collapsed) {
        background: linear-gradient(to right, #7F24EE, #0098DA, #0E15F9);
        color: white;
    }
</style>

<!-- Contenido de la Sección -->
@php
    $accordions = [
        [
            'id' => 'acordeonLineas',
            'title' => 'Resumen de Líneas Telefónicas',
            'icon' => 'fa-phone',
            'sections' => ['axe', 'cisco', 'ericsson', 'externo', 'total'],
            'data' => $lineas
        ],
        [
            'id' => 'acordeonDeposito',
            'title' => 'Resumen de Equipos en Depósito',
            'icon' => 'fa-warehouse',
            'sections' => ['cortijos', 'nea'],
            'data' => $depositos
        ],
        [
            'id' => 'acordeonRedes',
            'title' => 'Resumen Redes Corporativas',
            'icon' => 'fa-network-wired',
            'sections' => ['titulo'],
            'data' => []
        ]
    ];
@endphp

@foreach($accordions as $accordion)
    <div class="accordion mb-3" id="{{ $accordion['id'] }}">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $accordion['id'] }}-content" aria-expanded="false" aria-controls="{{ $accordion['id'] }}-content">
                    <i class="fa-solid {{ $accordion['icon'] }} me-2"></i>{{ $accordion['title'] }}
                </button>
            </h2>
            <div id="{{ $accordion['id'] }}-content" class="accordion-collapse collapse">
                <div class="accordion-body p-2">
                    @foreach($accordion['sections'] as $section)
                        <h6 class="text-primary mb-2">{{ ucfirst($section) }}</h6>
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-2 mb-3">
                            @php
                                $items = [
                                    'asignada' => ['icon' => 'fa-check', 'color' => '#63E6BE', 'label' => 'Asignadas'],
                                    'disponible' => ['icon' => 'fa-arrow-up', 'color' => '#397ef3', 'label' => 'Disponibles'],
                                    'bloqueada' => ['icon' => 'fa-ban', 'color' => '#fc883b', 'label' => 'Bloqueadas'],
                                    'porverificar' => ['icon' => 'fa-exclamation', 'color' => '#FFD43B', 'label' => 'Por Verificar'],
                                    'poreliminar' => ['icon' => 'fa-xmark', 'color' => '#f53246', 'label' => 'Por Eliminar'],
                                    'total' => ['icon' => 'fa-hashtag', 'color' => '#d158e9', 'label' => 'Total']
                                ];
                            @endphp
                            @foreach($items as $key => $item)
                                <div class="col">
                                    <div class="btn-gradient-outline p-2 text-center">
                                        <small class="d-block mb-1">
                                            <i class="fa-solid {{ $item['icon'] }}" style="color: {{ $item['color'] }};"></i>
                                            {{ $item['label'] }}
                                        </small>
                                        <span class="fs-5 fw-bold">
                                            @if($accordion['id'] == 'acordeonRedes')
                                                00
                                            @else
                                                {{ $accordion['data'][$section][$key] ?? 0 }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection