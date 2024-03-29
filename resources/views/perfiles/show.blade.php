@extends('layouts.app')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" />

@endsection


@section('content')

    <div class="container">

        <div class="row row-principal row-height-fix">

            <div class="col-12 datos">

                <div class="row">

                    <div class="col-8">

                        <div class="mb-3">

                            <div class="perfil-imagen m-0">

                                @if($perfil->imagen != null)

                                    <img src="/storage/perfiles/imagenes/{{ $perfil->imagen }}" alt="Foto Perfil">

                                @else

                                    <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil">

                                @endif

                            </div>

                        </div>

                        <div class="datos">

                            <p class="datos-nombre">{{ $perfil->usuario->name }}</p>

                            @if($perfil->direccion != null)

                                <p class="iconos-datos"><i class="fas fa-map-marker-alt"></i>{{ $perfil->direccion }}, {{ $perfil->colonia }}</p>

                            @endif

                            @if($perfil->telefono != null)

                                <p class="iconos-datos"><i class="fas fa-phone"></i>{{ $perfil->telefono }}</p>

                            @endif

                            <p class="iconos-datos"><i class="fas fa-envelope"></i>{{ $perfil->usuario->email }}</p>

                            <p>Miembro desde {{ $perfil->usuario->created_at->diffForHumans() }}</p>

                        </div>

                    </div>

                    <div class="col-4">

                        <div class="resenas">
                            <ul class="nav nav-tabs" id="myTab">

                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#primera" role="tab" aria-controls="home" aria-selected="true">Como ofertante</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#segunda" role="tab" aria-controls="profile" aria-selected="false">Como trabajador</a>
                                </li>

                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active tab-div" id="primera" role="tabpanel" aria-labelledby="home-tab">

                                    @if($rating_ofertante)

                                        <p class="text-center reseñas-subtitulo">Con {{ count($resenas_ofertante) }} reseñas.</p>

                                        <div class="d-flex justify-content-center rating-stars">

                                            <p class="align-self-center m-0 mr-2">{{ round($rating_ofertante,1) }}</p>

                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $rating_ofertante)
                                                    <i class="fas fa-star align-self-center "></i>
                                                @else
                                                    <i class="far fa-star align-self-center"></i>
                                                @endif
                                            @endfor

                                        </div>

                                    @else

                                        <p>Este usuario aún no tiene reseñas como ofertante.</p>

                                    @endif

                                </div>

                                <div class="tab-pane fade tab-div" id="segunda" role="tabpanel" aria-labelledby="profile-tab">

                                    @if($rating_trabajador)

                                        <p class="text-center reseñas-subtitulo">Con {{ count($resenas_trabajador) }} reseñas.</p>

                                        <div class="d-flex justify-content-center rating-stars">

                                            <p class="align-self-center m-0 mr-2">{{ round($rating_trabajador,1) }}</p>

                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $rating_trabajador)
                                                    <i class="fas fa-star align-self-center "></i>
                                                @else
                                                    <i class="far fa-star align-self-center"></i>
                                                @endif
                                            @endfor

                                        </div>

                                    @else

                                        <p>Este usuario aún no tiene reseñas como trabajador.</p>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-12 mt-5">

                <div class="d-flex justify-content-between mb-3">

                    <p class="titulo">Acerca de mi</p>

                </div>

                <div class="row contenido-acerca">

                    <div class="col-4">

                        @if($perfil->titulo != null)

                            <p class="acerca-titulo">"{{ $perfil->titulo }}"</p>

                        @else

                            <p class="acerca-titulo">"El usuario no ha actualizado esta información"</p>

                        @endif

                    </div>

                    <div class="col-8">

                        @if($perfil->acerca_de_mi != null)

                            <p class="acerca-descripcion">"{{ $perfil->acerca_de_mi }}"</p>

                        @else

                            <p class="acerca-descripcion">"El usuario no ha actualizado esta información"</p>

                        @endif

                    </div>


                </div>

            </div>

            <div class="col-12 mt-5">

                <div class="d-flex justify-content-between mb-3">

                    <p class="titulo">Habilidades</p>

                </div>

                <div class="row contenido-habilidades">

                    <div class="col-12 col-md-3 text-center">

                        <h3 class="habilidades-titulo">Educación</h3>

                        @if($perfil->educacion != null)

                            <span class="habilidades-contenido">{{ $perfil->educacion }}</span>

                        @else

                            <p class="habilidades-actualiza">"El usuario no ha actualizado esta información"</p>

                        @endif

                    </div>

                    <div class="col-12 col-md-3 text-center">

                        <h3 class="habilidades-titulo">Especialidad</h3>

                        @if($perfil->especialidad != null)

                            <span class="habilidades-contenido">{{ $perfil->especialidad }}</span>

                        @else

                            <p class="habilidades-actualiza">"El usuario no ha actualizado esta información"</p>

                        @endif

                    </div>

                    <div class="col-12 col-md-3 text-center">

                        <h3 class="habilidades-titulo">Trabajo</h3>

                        @if($perfil->trabajo != null)

                            <span class="habilidades-contenido">{{ $perfil->trabajo }}</span>

                        @else

                            <p  class="habilidades-actualiza">"Sin información"</p>

                        @endif

                    </div>

                    <div class="col-12 col-md-3 text-center">

                        <h3 class="habilidades-titulo">Idiomas</h3>

                        @if($perfil->idiomas != null)
                            @php
                                $idiomas = explode(",", $perfil->idiomas);
                            @endphp

                            @foreach($idiomas as $idioma)

                                <span class="habilidades-contenido">{{$idioma}}</span>

                            @endforeach
                        @else

                            <p  class="habilidades-actualiza">"Sin información"</p>

                        @endif

                    </div>

                </div>

            </div>

            <div class="col-12 mt-5">

                <div class="d-flex justify-content-between mb-3">

                    <p class="titulo">Curriculum</p>

                </div>

                <div class="contenido-curriculum">

                    @if($perfil->cv != null)

                    <a href="/storage/perfiles/cv/{{ $perfil->cv }}" class="btn  ml-5 btn-cancelar" target="_blank">Descargar CV</a>

                    @else

                        <p class="acerca-titulo">"No hay un CV disponible"</p>

                    @endif

                </div>

            </div>

            <div class="col-12 mt-5">
                <form action="">
                    <div class="d-flex justify-content-between mb-3">

                        <p class="titulo">Reseñas</p>

                    </div>

                    <div class="resenas">
                        <ul class="nav nav-tabs" id="myTab">

                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#primera2" role="tab" aria-controls="home" aria-selected="true">Como ofertante</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#segunda2" role="tab" aria-controls="profile" aria-selected="false">Como trabajador</a>
                            </li>

                        </ul>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active tab-div" id="primera2" role="tabpanel" aria-labelledby="home-tab">

                                @if(count($resenas_ofertante) != 0)

                                    <p class="text-left reseñas-subtitulo"> {{ count($resenas_ofertante) }} reseñas.</p>

                                    <div class="row">

                                        @foreach($resenas_ofertante as $resena)

                                            <div class="col-3 resena-container d-flex p-2 mr-2 mb-2">

                                                @if($resena->UsuarioCalificador->perfil->imagen != null)

                                                    <img src="/storage/perfiles/imagenes/{{$resena->UsuarioCalificador->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-barra">

                                                @else

                                                    <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil" class="foto-perfil-barra">

                                                @endif

                                                <div>

                                                    <div class="d-flex justify-content-center rating-stars">

                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $resena->rate)
                                                                <i class="fas fa-star align-self-center "></i>
                                                            @else
                                                                <i class="far fa-star align-self-center"></i>
                                                            @endif
                                                        @endfor

                                                        <p class="align-self-center m-0 ml-2">{{ $resena->rate }}</p>

                                                    </div>

                                                    <p>"{{ $resena->contenido}}"</p>

                                                    <p class="m-0">{{ $resena->created_at->diffForHumans() }}</p>

                                                </div>

                                            </div>

                                        @endforeach

                                    </div>

                                @else

                                    <p>Este usuario aún no tiene reseñas como ofertante.</p>

                                @endif

                            </div>

                            <div class="tab-pane fade tab-div" id="segunda2" role="tabpanel" aria-labelledby="profile-tab">

                                @if(count($resenas_trabajador) != 0)

                                    <p class="text-left reseñas-subtitulo"> {{ count($resenas_trabajador) }} reseñas.</p>

                                    <div class="row">

                                        @foreach($resenas_trabajador as $resena)

                                            <div class="col-3 resena-container d-flex p-2 mr-2 mb-2">

                                                @if($resena->UsuarioCalificador->perfil->imagen != null)

                                                    <img src="/storage/perfiles/imagenes/{{ $resena->UsuarioCalificador->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-barra">

                                                @else

                                                    <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil" class="foto-perfil-barra">

                                                @endif

                                                <div>

                                                    <div class="d-flex justify-content-center rating-stars">

                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $resena->rate)
                                                                <i class="fas fa-star align-self-center "></i>
                                                            @else
                                                                <i class="far fa-star align-self-center"></i>
                                                            @endif
                                                        @endfor

                                                        <p class="align-self-center m-0 ml-2">{{ $resena->rate }}</p>

                                                    </div>

                                                    <p>"{{ $resena->contenido}}"</p>

                                                    <p class="m-0">{{ $resena->created_at->diffForHumans() }}</p>

                                                </div>

                                            </div>

                                        @endforeach

                                    </div>

                                @else

                                    <p>Este usuario aún no tiene reseñas como trabajador.</p>

                                @endif

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
