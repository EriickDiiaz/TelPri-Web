<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <!-- Enlace al CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Iconos de Font Awesome -->
    <script src="https://kit.fontawesome.com/708e2917d6.js" crossorigin="anonymous"></script>

    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Estilos personalizados */
        html, body {
            height: 100%;
        }
        .sidebar {
            background-color: #2B3035;
            height: calc(100vh - 56px); /* Altura total menos la altura del navbar */
            position: fixed;
            top: 56px; /* Altura del navbar */
            left: 0;
            border-radius: 0 50px 50px 0;
            overflow-y: auto; /* Habilita el scroll vertical independiente */
            scrollbar-width: thin; /* Para Firefox */
            scrollbar-color: #0098DA #2B3035; /* Para Firefox */
        }
        .sidebar::-webkit-scrollbar {
            width: 6px; /* Para Chrome, Safari y Opera */
        }
        .sidebar::-webkit-scrollbar-track {
            background: #2B3035;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background-color: #0098DA;
            border-radius: 3px;
        }
        .sidebar a {
            color: #0098DA;
        }
        .sidebar a:hover {
            color: #4658E5;
        }
        .admin-navbar {
            background: linear-gradient(to right, #7F24EE, #0098DA, #0E15F9);
        }
        /* Ajuste de espaciado para el contenido principal */
        body {
            padding-top: 56px; /* Altura del navbar */
            display: flex;
            flex-direction: column;
        }
        .contenido {
            margin-left: 250px; /* Ancho del sidebar */
            padding: 20px;
            min-height: calc(80vh - 56px); /* Altura total menos la altura del navbar */
        }
        .container-fluid {
            flex: 1;
        }
        .footer {
            border-radius: 50px 50px 0 0;
            margin-left: 250px; /* Ancho del sidebar */
            padding: 10px 0;
            background-color: #2B3035;
        }
        
        /* Nueva clase para botones con borde gradiente */
        .btn-gradient-outline {
            border-radius: 10px;
            background-color: transparent;
            border: 2px solid transparent;
            background-image: linear-gradient(#2B3035, #2B3035), linear-gradient(to right, #7F24EE, #0098DA, #0E15F9);
            background-origin: border-box;
            background-clip: content-box, border-box;
            box-shadow: 2px 1000px 1px #2B3035 inset;
            transition: all 0.3s ease;
        }
        
        .btn-gradient-outline:hover {
            box-shadow: none;
            transform: translateY(-3px);
            color: #fff;
        }
    </style>
</head>
<body>

<!-- Navbar para administración de usuario -->
<nav class="navbar navbar-expand-lg admin-navbar fixed-top">
    <div class="container-fluid">
        <div class="col-4">
            <i class="fa-solid fa-shoe-prints"></i> ... Breadcrumb ... 
        </div>
        <div class="col-4 text-center">
            <i class="fa-regular fa-calendar"></i>
            <span id="fechaHora">{{ $fechaHoraActual }}</span>
        </div>
        <div class="col-4">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                    <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fa-solid fa-right-to-bracket"></i> {{ __('Ingresar') }}
                                </a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="fa-solid fa-check-to-slot"></i> {{ __('Registrar') }}
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('usuarios/'.Auth::user()->id.'/edit')}}">
                                    <i class="fa-solid fa-gear"></i> {{ __('Modificar Usuario') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-to-bracket"></i> {{ __('Cerrar Sesión') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                    </li>
                </ul>
            </div>
        </div>   
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="sidebar col-md-3 col-lg-2">
            <div class="d-flex flex-column h-100">
                <div class="d-grid gap-2 col-12 mx-auto">
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <img src="{{ asset('imagenes/Logo_TelPriWeb_Wh.png') }}" alt="Logo TelPri" style="width: 90%;" class="m-2 pt-2">
                    </a>
                    <div class="border-top my-2 nav-item"></div>
                    <a class="btn btn-gradient-outline btn-sm text-start" href="{{ url('/lineas') }}">
                        <i class="fa-solid fa-phone m-2"></i>Líneas
                    </a>
                    <a class="btn btn-gradient-outline btn-sm text-start" href="{{ url('/callcenters') }}">
                        <i class="fa-solid fa-headset m-2"></i>CallCenters
                    </a>
                    <a class="btn btn-gradient-outline btn-sm text-start" href="{{ url('/depositos') }}">
                        <i class="fa-solid fa-warehouse m-2"></i>Depósitos
                    </a>
                    <a class="btn btn-gradient-outline btn-sm text-start" href="#">
                        <i class="fa-solid fa-network-wired m-2"></i>Redes Corp.
                    </a>
                    @can('Menu Localidades')
                    <div class="border-top my-2 nav-item"></div>                    
                    <a class="btn btn-gradient-outline btn-sm text-start" href="{{ url('/localidades') }}">
                        <i class="fa-solid fa-location-dot m-2"></i>Adm. de Localidades
                    </a>
                    <a class="btn btn-gradient-outline btn-sm text-start" href="{{ url('/campos') }}">
                        <i class="fa-solid fa-ethernet m-2"></i>Adm. de Campos
                    </a>
                    <a class="btn btn-gradient-outline btn-sm text-start" href="{{ url('/usuarios') }}">
                        <i class="fa-solid fa-person m-2"></i>Adm. de Usuarios
                    </a>
                    @endcan
                    @can('Menu Sistema')
                    <div class="border-top my-2 nav-item"></div>                    
                    <a class="btn btn-gradient-outline btn-sm text-start" href="{{ url('/roles') }}">
                        <i class="fa-solid fa-address-card m-2"></i>Adm. de Roles
                    </a>
                    <a class="btn btn-gradient-outline btn-sm text-start" href="{{ url('/permisos') }}">
                        <i class="fa-solid fa-list-check m-2"></i>Adm. de Permisos
                    </a>
                    @endcan 
                </div>
                <div class="mt-auto text-center">
                    <img src="{{ asset('imagenes/Logo_cantv_Wh.png') }}" alt="Logo CANTV" class="img-fluid logo-footer m-3" style="width: 40%;">
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="contenido col-md-9 col-lg-10 ms-sm-auto">
            @yield('contenido')
        </main>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <img src="{{ asset('imagenes/Logo_TelPri_Wh.png') }}" alt="Imagen 2" class="img-fluid" style="width: 10%;">
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-12 text-center">
                <p>© 2024 TelPri-Web. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@stack('scripts')

</body>
</html>