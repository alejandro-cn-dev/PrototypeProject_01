<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Default') | {{ config('system_name', 'AdminLTE 2') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" type="image/jpg" href="{{ asset(config('adminlte.logo_img')) }}" />
    @yield('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">

        <!-- Navegación-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <img src="{{ asset(config('adminlte.logo_img')) }}" alt="Logo pressitex" style="widht: 30px; height: 30px;">
                <a class="navbar-brand" href="#!">{{ config('system_name', 'default') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="/inicio">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="/lista">Productos</a></li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Productos</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/lista">Todos los productos</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="/categories">Por categorias</a></li>
                                <li><a class="dropdown-item" href="#!">Tendencias</a></li>
                                <li><a class="dropdown-item" href="#!">Nuevos</a></li>
                            </ul>
                        </li>                         -->
                        <!-- Test de reportes - Quitar luego -->
                        {{-- <li class="nav-item"><a class="nav-link" href="/reporte_test">TEST</a></li> --}}
                        <li class="nav-item"><a class="nav-link" href="/info">Sobre nosotros</a></li>
                    </ul>
                    <!-- <div class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            Carrito
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </div> -->
                    <div class="d-flex">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                            <!-- Links de autenticación-->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
                                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <!-- {{ Auth::user()->ci }} -->
                                        <!-- investigar por que solo recupera el campo 'name' -->
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('home.index') }}">Panel de
                                            administración</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Contenido-->
        <!-- <main class="py-4"> -->
        <main>
            @yield('content')
        </main>
        <!-- Pie-->
        <footer class="py-5 bg-dark">
            <div class="container">
                <div class="row g-3 mb-3">
                    <div class="col-md-4 text-white">
                        <h3>Telefonos y correo</h3>
                        <ul class="m-0">
                            @foreach ( explode(',', config('system_phone_contact')) as $telefono)
                                <li>{{ $telefono }}</li>
                            @endforeach
                            @foreach ( explode('|', config('system_email')) as $email )
                                <li>{{ $email }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4 text-white">
                        <h3>Dirección</h3>
                        {{-- <p>Calle Isaac Tamayo, Galer&iacute;a "Centro Comercial Isaac Tamayo", 1er Piso (Local 103 -
                            104) La Paz, Bolivia, Bolivia</p> --}}
                        <p>{{ config('system_address') }}</p>
                    </div>
                    <div class="col-md-4 text-white">
                        <h3>Redes Sociales</h3>
                        <a href="https://www.facebook.com/telasbolivia"><img src="/favicons/facebook-logo-0.png"
                                alt="Facebook logo" style="width:40px; height:40px;"></a>
                        <a href="https://www.tiktok.com/@telas.bolivia"><img src="/favicons/tiktok-logo-0-1.png"
                                alt="TikTok logo" style="width:40px; height:40px;"></a>
                    </div>
                </div>

                Contacto:

                <p class="m-0 text-white">&copy; 2024 Alejandro Conde - Todos los derechos reservados</p>
            </div>
        </footer>
    </div>
    <script src="https://kit.fontawesome.com/856ec43d17.js" crossorigin="anonymous"></script>
    @yield('js')
</body>

</html>
