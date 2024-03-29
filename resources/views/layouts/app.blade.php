<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <link rel="icon" type="image/png" href="{{ asset('storage/img/logo.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,700;1,600&display=swap" rel="stylesheet">

    {{-- Estilos --}}
    @yield('styles')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">

                    <img src="/storage/img/logo.png" alt="Logo YoNecesito" class="logo-barra">

                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">

                    <span class="navbar-toggler-icon"></span>

                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        <a href="#" class="nav-item nav-link publicar-oferta" data-toggle="modal" data-target="#modalPublicar">¿Qué Necesitas?</a>

                        @if(Auth::user())

                            <a href="{{ route('tarea.mistareas') }}" class="nav-item nav-link">Mis Tareas</a>

                        @endif

                        <a href="{{ route('tarea.tareas') }}" class="nav-item nav-link">Ver Tareas</a>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">

                                <a class="nav-link" style="cursor:pointer" data-toggle="modal" data-target="#loginModal">{{ __('Login') }}</a>

                            </li>

                            @if (Route::has('register'))

                                <li class="nav-item">

                                    <a class="nav-link" style="cursor:pointer" data-toggle="modal" data-target="#registerModal">{{ __('Register') }}</a>

                                </li>

                            @endif

                        @else

                            <li class="nav-item dropdown">

                                <div class="d-flex">

                                    @if(Auth::user()->perfil->imagen != null)

                                        <img src="/storage/perfiles/imagenes/{{ Auth::user()->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-barra">

                                    @else

                                        <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil" class="foto-perfil-barra">

                                    @endif

                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                        {{ Auth::user()->name }}

                                        @if(
                                            Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaOferta')->count() +
                                            Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaPregunta')->count() +
                                            Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaRespuestaOferta')->count() +
                                            Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaRespuestaPregunta')->count() +
                                            Auth::user()->unreadNotifications->where('type','App\Notifications\NuevoMensaje')->count() +
                                            Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaAsignacion')->count() > 0)
                                            <span class="btn btn-sm circular">
                                                {{
                                                    Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaOferta')->count() +
                                                    Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaPregunta')->count() +
                                                    Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaRespuestaOferta')->count() +
                                                    Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaRespuestaPregunta')->count() +
                                                    Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaAsignacion')->count() +
                                                    Auth::user()->unreadNotifications->where('type','App\Notifications\NuevoMensaje')->count()
                                                }}
                                            </span>
                                        @endif
                                        <span class="caret"></span>

                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('perfil.edit', ['perfil' => Auth::user()->perfil->id]) }}">

                                            Perfil

                                        </a>

                                        <a class="dropdown-item" href="{{ route('notificaciones.ofertas') }}">

                                            Ofertas <span class="btn btn-sm circular float-right">{{ Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaOferta')->count() }}</span>

                                        </a>

                                        <a class="dropdown-item" href="{{ route('notificaciones.preguntas') }}">

                                            Preguntas <span class="btn btn-sm circular float-right">{{ Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaPregunta')->count() }}</span>

                                        </a>

                                        <a class="dropdown-item" href="{{ route('notificaciones.respuestas') }}">

                                            Respuestas <span class="btn btn-sm circular float-right">{{ Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaRespuestaOferta')->count() +
                                                Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaRespuestaPregunta')->count() }}</span>

                                        </a>

                                        <a class="dropdown-item" href="{{ route('notificaciones.asignaciones') }}">

                                            Asignaciones <span class="btn btn-sm circular float-right">{{ Auth::user()->unreadNotifications->where('type','App\Notifications\NuevaAsignacion')->count() }}</span>

                                        </a>

                                        <a class="dropdown-item" href="{{ route('mensajes.mis_mensajes') }}">

                                            Mensajes <span class="btn btn-sm circular float-right">{{ Auth::user()->unreadNotifications->where('type','App\Notifications\NuevoMensaje')->count() }}</span>

                                        </a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"

                                        onclick="event.preventDefault();

                                                        document.getElementById('logout-form').submit();">

                                            {{ __('Logout') }}

                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                                            @csrf

                                        </form>

                                    </div>

                                </div>

                            </li>

                        @endguest

                    </ul>

                </div>

            </div>

        </nav>

        <main class="py-4">

            @yield('content')

        </main>

    </div>

    @include('ui.modalPublicar')

    @include('ui.modalLogin')

    @include('ui.modalRegister')

    @yield('scripts')

    @yield('scripts2')

</body>
</html>
