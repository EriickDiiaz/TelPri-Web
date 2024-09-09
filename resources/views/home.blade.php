@extends('layout/template')

@section('title','Telpri-Web')
@section('contenido')

<!-- Mensajes y Notificaciones -->
@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <i class="bi bi-check2-circle"></i>
        {{ Session::get('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Titulo de la Sección -->
<div class="row justify-content-center">
    <div class="justify-content-center text-center">
        <div class="">
            <h4>Bienvenido, {{ Auth::user()->name }}:</h4>
            <div class=" text-center">
                <img src="{{ asset('imagenes/Logo_TelPriWeb_Wh.png') }}" alt="Imagen 2" class="img-fluid" style="width: 10%;">
            </div>
        </div>
    </div>
</div>

<!-- Contenido de la Sección -->
<div class="accordion my-3" id="acordeonLineas">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed btn-telpri" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                <h4><i class="fa-solid fa-phone m-2"></i>Resumen de Líneas Telefónicas.</h4>
            </button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
            <div class="accordion-body">
                <h5 style="color: #0098DA;">Axe.</h5>
                <div class="d-flex justify-content-between mb-2">
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-check m-2" style="color: #63E6BE;"></i>Asignadas:</span>
                        <div>
                            <h4>{{ $axeAsig }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-arrow-up m-2" style="color: #397ef3;"></i>Disponibles:</span>
                        <div>
                            <h4>{{ $axeDisp }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-ban m-2" style="color: #fc883b;"></i>Bloqueadas:</span>
                        <div>
                            <h4>{{ $axeBloq }}</h4>
                        </div>
                    </div>        
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-exclamation m-2" style="color: #FFD43B;"></i>Por Verificar:</span>
                        <div>
                            <h4>{{ $axeVeri }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-xmark m-2" style="color: #f53246;"></i>Por Eliminar:</span>
                        <div>
                            <h4>{{ $axeElim }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-hashtag m-2" style="color: #d158e9;"></i>Total:</span>
                        <div>
                            <h4>{{ $totalAxe }}</h4>
                        </div>
                    </div>
                </div>

                <h5 style="color: #0098DA;">Cisco.</h5>
                <div class="d-flex justify-content-between mb-2">
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-check m-2" style="color: #63E6BE;"></i>Asignadas:</span>
                        <div>
                            <h4>{{ $ciscoAsig }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-arrow-up m-2" style="color: #397ef3;"></i>Disponibles:</span>
                        <div>
                            <h4>{{ $ciscoDisp }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-ban m-2" style="color: #fc883b;"></i>Bloqueadas:</span>
                        <div>
                            <h4>{{ $ciscoBloq }}</h4>
                        </div>
                    </div>        
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-exclamation m-2" style="color: #FFD43B;"></i>Por Verificar:</span>
                        <div>
                            <h4>{{ $ciscoVeri }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-xmark m-2" style="color: #f53246;"></i>Por Eliminar:</span>
                        <div>
                            <h4>{{ $ciscoElim }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-hashtag m-2" style="color: #d158e9;"></i>Total:</span>
                        <div>
                            <h4>{{ $totalCisco }}</h4>
                        </div>
                    </div>
                </div>

                <h5 style="color: #0098DA;">Ericsson.</h5>
                <div class="d-flex justify-content-between mb-2">
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-check m-2" style="color: #63E6BE;"></i>Asignadas:</span>
                        <div>
                            <h3>{{ $ericssonAsig }}</h3>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-arrow-up m-2" style="color: #397ef3;"></i>Disponibles:</span>
                        <div>
                            <h3>{{ $ericssonDisp }}</h3>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-ban m-2" style="color: #fc883b;"></i>Bloqueadas:</span>
                        <div>
                            <h4>{{ $ericssonBloq }}</h4>
                        </div>
                    </div>        
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-exclamation m-2" style="color: #FFD43B;"></i>Por Verificar:</span>
                        <div>
                            <h3>{{ $ericssonVeri }}</h3>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-xmark m-2" style="color: #f53246;"></i>Por Eliminar:</span>
                        <div>
                            <h3>{{ $ericssonElim }}</h3>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-hashtag m-2" style="color: #d158e9;"></i>Total:</span>
                        <div>
                            <h3>{{ $totalEricsson }}</h3>
                        </div>
                    </div>
                </div>

                <h5 style="color: #0098DA;">Externo.</h5>
                <div class="d-flex justify-content-between mb-2">
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-check m-2" style="color: #63E6BE;"></i>Asignadas:</span>
                        <div>
                            <h3>{{ $externoAsig }}</h3>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-arrow-up m-2" style="color: #397ef3;"></i>Disponibles:</span>
                        <div>
                            <h3>{{ $externoDisp }}</h3>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-ban m-2" style="color: #fc883b;"></i>Bloqueadas:</span>
                        <div>
                            <h4>{{ $externoBloq }}</h4>
                        </div>
                    </div>        
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-exclamation m-2" style="color: #FFD43B;"></i>Por Verificar:</span>
                        <div>
                            <h3>{{ $externoVeri }}</h3>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-xmark m-2" style="color: #f53246;"></i>Por Eliminar:</span>
                        <div>
                            <h3>{{ $externoElim }}</h3>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-hashtag m-2" style="color: #d158e9;"></i>Total:</span>
                        <div>
                            <h3>{{ $totalExterno }}</h3>
                        </div>
                    </div>
                </div>

                <h5 style="color: #0098DA;">Total.</h5>
                <div class="d-flex justify-content-between mb-2">
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-check m-2" style="color: #63E6BE;"></i>Asignadas:</span>
                        <div>
                            <h4>{{ $totalAsig }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-arrow-up m-2" style="color: #397ef3;"></i>Disponibles:</span>
                        <div>
                            <h4>{{ $totalDisp }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-ban m-2" style="color: #fc883b;"></i>Bloqueadas:</span>
                        <div>
                            <h4>{{ $totalBloq }}</h4>
                        </div>
                    </div>                    
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-exclamation m-2" style="color: #FFD43B;"></i>Por Verificar:</span>
                        <div>
                            <h4>{{ $totalVeri }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-xmark m-2" style="color: #f53246;"></i>Por Eliminar:</span>
                        <div>
                            <h4>{{ $totalElim }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-hashtag m-2" style="color: #d158e9;"></i>Total:</span>
                        <div>
                            <h4>{{ $totalLineas }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="accordion my-3" id="acordeonDeposito">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed btn-telpri" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                <h4><i class="fa-solid fa-warehouse m-2"></i>Resumen de Equipos en Depósito.</h4>
            </button>
        </h2>
        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
            <div class="accordion-body">
                <h5 style="color: #0098DA;">Cortijos.</h5>
                <div class="d-flex justify-content-between mb-2">
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-check m-2" style="color: #63E6BE;"></i>Depósito:</span>
                        <div>
                            <h4>{{ $depCrtDep }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-arrow-up m-2" style="color: #397ef3;"></i>Instalado:</span>
                        <div>
                            <h4>{{ $depCrtIns }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-exclamation m-2" style="color: #FFD43B;"></i>Por Reparar:</span>
                        <div>
                            <h4>{{ $depCrtPRep }}</h4>
                        </div>
                    </div>        
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-ban m-2" style="color: #fc883b;"></i>Por Desincorporar:</span>
                        <div>
                            <h4>{{ $depCrtPDes }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-xmark m-2" style="color: #f53246;"></i>Desincorporado:</span>
                        <div>
                            <h4>{{ $depCrtDes }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-hashtag m-2" style="color: #d158e9;"></i>Total:</span>
                        <div>
                            <h4>{{ $totalDepCrt }}</h4>
                        </div>
                    </div>
                </div>

                <h5 style="color: #0098DA;">NEA.</h5>
                <div class="d-flex justify-content-between mb-2">
                <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-check m-2" style="color: #63E6BE;"></i>Depósito:</span>
                        <div>
                            <h4>{{ $depNeaDep }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-arrow-up m-2" style="color: #397ef3;"></i>Instalado:</span>
                        <div>
                            <h4>{{ $depNeaIns }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-exclamation m-2" style="color: #FFD43B;"></i>Por Reparar:</span>
                        <div>
                            <h4>{{ $depNeaPRep }}</h4>
                        </div>
                    </div>        
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-ban m-2" style="color: #fc883b;"></i>Por Desincorporar:</span>
                        <div>
                            <h4>{{ $depNeaPDes }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-xmark m-2" style="color: #f53246;"></i>Desincorporado:</span>
                        <div>
                            <h4>{{ $depNeaDes }}</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-hashtag m-2" style="color: #d158e9;"></i>Total:</span>
                        <div>
                            <h4>{{ $totalDepNea }}</h4>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>
    </div>
</div>

<div class="accordion my-3" id="acordeonRedes">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed btn-telpri" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTree" aria-expanded="true" aria-controls="panelsStayOpen-collapseTree">
                <h4><i class="fa-solid fa-network-wired m-2"></i>Resumen Redes Corporativas.</h4>
            </button>
        </h2>
        <div id="panelsStayOpen-collapseTree" class="accordion-collapse collapse">
            <div class="accordion-body">
                <h5 style="color: #0098DA;">Titulo.</h5>
                <div class="d-flex justify-content-between mb-2">
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-check m-2" style="color: #63E6BE;"></i>Item 1:</span>
                        <div>
                            <h4>00</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-arrow-up m-2" style="color: #397ef3;"></i>Item 2:</span>
                        <div>
                            <h4>00</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-exclamation m-2" style="color: #FFD43B;"></i>Item 3:</span>
                        <div>
                            <h4>00</h4>
                        </div>
                    </div>        
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-ban m-2" style="color: #fc883b;"></i>Item 4:</span>
                        <div>
                            <h4>00</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-xmark m-2" style="color: #f53246;"></i>Item 5:</span>
                        <div>
                            <h4>00</h4>
                        </div>
                    </div>
                    <div class="btn btn-telpri px-4 me-1">
                        <span><i class="fa-solid fa-hashtag m-2" style="color: #d158e9;"></i>Total:</span>
                        <div>
                            <h4>00</h4>
                        </div>
                    </div>
                </div>             
            </div>
        </div>
    </div>
</div>

@endsection
