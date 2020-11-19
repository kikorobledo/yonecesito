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

        <header style="background-image: url({{ asset('storage/img/1.jpg') }})">

            <div class="container">

                <div class="row contenedor_logo_menu ">

                    <div class="logo col-xs-12 col-md-3">
                        <a href="{{ route('inicio')}}"><img src="{{ asset('storage/img/logo.png') }}" style="width: 60px;" alt="Logotípo"></a>
                    </div>

                    <div class="menu col-xs-12 col-md-5">
                        <button class=" btn text-white p-3 border publicar-oferta" data-toggle="modal" data-target="#modalPublicar">¿Qué Necesitas?</button>
                        {{-- <a href="#">Categorías</a> --}}
                        <a href={{ route('tarea.tareas') }}>Ver Tareas</a>
                    </div>

                    @guest


                        <div class="login col-xs-12 col-md-4">

                            <a href="#" data-toggle="modal" data-target="#registerModal">Registrarse</a>

                            <a href="#" data-toggle="modal" data-target="#loginModal">Ingresar</a>

                        </div>

                    @else

                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item dropdown">

                                <div class="d-flex">

                                    @if(Auth::user()->perfil->imagen != null)

                                        <img src="/storage/perfiles/imagenes/{{ Auth::user()->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-barra border border-light">

                                    @else

                                        <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil" class="foto-perfil-barra">

                                    @endif

                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                        {{ Auth::user()->name }} <span class="caret"></span>

                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('perfil.edit', ['perfil' => Auth::user()->perfil->id]) }}">

                                            Perfil

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
                        </ul>

                    @endguest

                </div>

                <div class="row textos">

                    <div class="col-md-12">
                        <h2 class="primera_linea">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h2>
                        <h3 class="segunda_linea">Quia ut consequatur nisi ipsum eos, sint rem?</h3>
                        <a class="boton-header" href="#">Comenzar</a>
                    </div>

                </div>
            </div>

        </header>

        <section class="main">

            <section class="tipo_de_trabajos">

                <div class="container">

                    <div class="row">

                            <div class="col-12">

                                <h3 class="titulo-index">¿Qué trabajo necesitas?</h3>


                                <div class="contenedor_trabajos">

                                    <div class="trabajo">
                                        <a href="#" ><i class="fas fa-users"></i></a>
                                        <p>Limpieza de casas</p>
                                    </div>

                                    <div class="trabajo">
                                        <a href="#"><i class="fas fa-truck"></i></a>
                                        <p>Mudanza</p>
                                    </div>

                                    <div class="trabajo">
                                        <a href="#"><i class="fas fa-paint-roller"></i></a>
                                        <p>Trabajo de pintura</p>
                                    </div>

                                    <div class="trabajo">
                                        <a href="#"><i class="fas fa-leaf"></i></a>
                                        <p>Jardineria</p>
                                    </div>

                                    <div class="trabajo">
                                        <a href="#"><i class="fas fa-graduation-cap"></i></a>
                                        <p>Tutorías</p>
                                    </div>


                                    <div class="trabajo">
                                        <a href="#"><i class="fas fa-hammer"></i></a>
                                        <p>Carpinteria</p>
                                    </div>

                                    <div class="trabajo">
                                        <a href="#"><i class="fas fa-screwdriver"></i></a>
                                        <p>Mecánica</p>
                                    </div>



                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </section>

            <section class="caracteristicas">

                <div class="container">

                    <div class="row">

                        <div class="col-12 ">

                            <h3 class="titulo-index">¿Cómo funcionamos?</h3>

                            <p class="caracteristicas-texto">Lorem ipsum dolor, sit amet elit. Ad, accusantium amet! Doloremque suscipit aliquam ab vitae debitis iusto vel repudiandae?</p>

                        </div>

                        <!-- <div class="col-xs-12 col-md-4 caracteristica">

                            <img src="img/icono1.png" alt="" class="icono">

                            <h4 class="primera_linea">Lorem Ipsum</h4>

                            <p class="parrafo">Dolor sit amet, consectetur adipiscing elit. In dignissim odio ut sagittis elementum.</p>

                        </div>

                        <div class="col-xs-12 col-md-4 caracteristica">

                            <img src="img/icono2.png" alt="" class="icono">

                            <h4 class="primera_linea">Lorem Ipsum</h4>

                            <p class="parrafo">Dolor sit amet, consectetur adipiscing elit. In dignissim odio ut sagittis elementum.</p>

                        </div>

                        <div class="col-xs-12 col-md-4 caracteristica">

                            <img src="img/icono3.png" alt="" class="icono">

                            <h4 class="primera_linea">Lorem Ipsum</h4>

                            <p class="parrafo">Dolor sit amet, consectetur adipiscing elit. In dignissim odio ut sagittis elementum.</p>

                        </div> -->

                        <div class="col-8 caracteristicas-wraper">

                            <a href="{{ route('informacion.publicar') }}" class="caracteristicas-primero">Publica lo que necesitas</a>

                            <a href="" class="caracteristicas-segundo">Encuentra una tarea</a>

                        </div>

                    </div>

                </div>

            </section>

            <section class="ultimas_ofertas">

                <div class="container">
                    <div class="row">

                        <div class="col-12">

                            <h3 class="titulo-index">Últimas Ofertas</h3>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-12">

                            <div class="ofertas">

                                <div class="oferta-index">

                                    <p class="tipo_oferta">Entrega</p>

                                    <div class="oferta_conjunto">
                                        <img src="{{ asset('storage/img/mujer.png') }}" alt="usuario">
                                        <p class="descripcion">Entregar paquete de comida</p>
                                        <p class="precio">$100</p>
                                    </div>

                                    <div class="estrellas">
                                        <i class="fas fa-star"></i>
                                        <p class="estrellas">5 Estrellas</p>
                                    </div>
                                </div>

                                <div class="oferta-index">

                                    <p class="tipo_oferta">Pintura</p>

                                    <div class="oferta_conjunto">
                                        <img src="{{ asset('storage/img/hombre.png') }}" alt="usuario">
                                        <p class="descripcion">Pintar fachada de casa</p>
                                        <p class="precio">$150</p>
                                    </div>

                                    <div class="estrellas">
                                        <i class="fas fa-star"></i>
                                        <p class="estrellas">4 Estrellas</p>
                                    </div>
                                </div>

                                <div class="oferta-index">

                                    <p class="tipo_oferta">Limpieza</p>

                                    <div class="oferta_conjunto">
                                        <img src="{{ asset('storage/img/mujer.png') }}" alt="usuario">
                                        <p class="descripcion">Limpiar salon de eventos</p>
                                        <p class="precio">$200</p>
                                    </div>

                                    <div class="estrellas">
                                        <i class="fas fa-star"></i>
                                        <p class="estrellas">5 Estrellas</p>
                                    </div>
                                </div>

                                <div class="oferta-index">

                                    <p class="tipo_oferta">Mecánica</p>

                                    <div class="oferta_conjunto">
                                        <img src="{{ asset('storage/img/hombre.png') }}" alt="usuario">
                                        <p class="descripcion">Reparar carroceria de auto</p>
                                        <p class="precio">$450</p>
                                    </div>

                                    <div class="estrellas">
                                        <i class="fas fa-star"></i>
                                        <p class="estrellas">4 Estrellas</p>
                                    </div>
                                </div>

                            </div>

                            <div class="ofertas">

                                <div class="oferta-index">

                                    <p class="tipo_oferta">Chofer</p>

                                    <div class="oferta_conjunto">
                                        <img src="{{ asset('storage/img/hombre.png') }}" alt="usuario">
                                        <p class="descripcion">Servicio de chofer por un día</p>
                                        <p class="precio">$300</p>
                                    </div>

                                    <div class="estrellas">
                                        <i class="fas fa-star"></i>
                                        <p class="estrellas">3 Estrellas</p>
                                    </div>
                                </div>

                                <div class="oferta-index">

                                    <p class="tipo_oferta">Cocina</p>

                                    <div class="oferta_conjunto">
                                        <img src="{{ asset('storage/img/mujer.png') }}" alt="usuario">
                                        <p class="descripcion">Servicio de chef por fin de semana</p>
                                        <p class="precio">$650</p>
                                    </div>

                                    <div class="estrellas">
                                        <i class="fas fa-star"></i>
                                        <p class="estrellas">5 Estrellas</p>
                                    </div>
                                </div>

                                <div class="oferta-index">

                                    <p class="tipo_oferta">Jardineria</p>

                                    <div class="oferta_conjunto">
                                        <img src="{{ asset('storage/img/mujer.png') }}" alt="usuario">
                                        <p class="descripcion">Limpieza de jardin</p>
                                        <p class="precio">$100</p>
                                    </div>

                                    <div class="estrellas">
                                        <i class="fas fa-star"></i>
                                        <p class="estrellas">5 Estrellas</p>
                                    </div>
                                </div>

                                <div class="oferta-index">

                                    <p class="tipo_oferta">Fotografía</p>

                                    <div class="oferta_conjunto">
                                        <img src="{{ asset('storage/img/mujer.png') }}" alt="usuario">
                                        <p class="descripcion">Servicio de fotografo para evento</p>
                                        <p class="precio">$390</p>
                                    </div>

                                    <div class="estrellas">
                                        <i class="fas fa-star"></i>
                                        <p class="estrellas">5 Estrellas</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </section>

            <section class="testimoniales">

                <div class="container">

                    <div class="row">

                        <div class="col-12">

                            <h3 class="titulo-index">Lo que nuestros usuarios dicen..</h3>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12 cliente">

                            <div class="foto">

                                <img src="{{ asset('storage/img/hombre.png') }}" alt="">

                            </div>

                            <div class="review">

                                <p class="texto">"Lorem ipsum dolor sit amet consectetur adipisicing elit. Est quibusdam maxime quisquam natus iure rerum, quaerat temporibus, beatae nostrum nulla assumenda."</p>
                                <p class="nombre">- Jhon Doe</p>

                            </div>

                        </div>

                        <div class="col-12 cliente derecha">

                            <div class="foto">

                                <img src="{{ asset('storage/img/mujer.png') }}" alt="">

                            </div>

                            <div class="review">

                                <p class="texto">"Est quibusdam maxime quisquam natus iure rerum, quaerat temporibus, beatae nostrum nulla assumenda. Sa amet consectetur adipisicing elit. "</p>
                                <p class="nombre">- Susan Grace</p>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </section>

        <footer>

            <section class="redes_sociales">

                <div class="container">

                    <div class="row redes">

                        <div class="red col-xs-12 col-md-3">
                            <a href="#"><i class="fab fa-twitter"></i></a>

                            <a href="#"><i class="fab fa-facebook"></i></a>

                            <a href="#"><i class="fab fa-instagram"></i></a>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <p class="copyright">© Copyrigth 2020, Todos Los Derechos Reservados - Potítica de Privacidad - Legal - Términos de uso</p>
                        </div>
                    </div>

                </div>

            </section>

        </footer>

    </div>

    @include('ui.modalPublicar')

    @include('ui.modalLogin')

    @include('ui.modalRegister')

    @yield('scripts')

    @yield('scripts2')

</body>
</html>
