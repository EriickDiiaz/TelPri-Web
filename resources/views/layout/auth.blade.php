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

    <style>
        /* Estilos personalizados */
        html, body {
            height: 100%;
        }
        .admin-navbar {
            background: linear-gradient(to right, #7F24EE, #0098DA, #0E15F9);
        }
        body {
            padding-top: 4%; /* Altura del navbar */
            display: flex;
            flex-direction: column;
        }
        /* Ajuste de espaciado para el contenido principal */
        .footer{          
            padding: 10px 0;    
            position: relative;
            bottom: 0;
            text-align: center;
        }               
    </style>
</head>
<body>

<!-- Navbar para administración de usuario -->
<nav class="navbar navbar-expand-lg admin-navbar fixed-top">
    <div class="container-fluid">
        <div class="col-4">
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

<!-- Contenido principal -->
<main style="">
    @yield('contenido')
</main>

<!-- Footer -->
<footer class="footer mt-auto">
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <img src="{{ asset('imagenes/Logo_TelPri_Wh.png') }}" alt="Imagen 2" class="img-fluid" style="width: 10%;">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <p>
                    © 2024 TelPri-Web. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('css/bootstrap-5.3.3/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
