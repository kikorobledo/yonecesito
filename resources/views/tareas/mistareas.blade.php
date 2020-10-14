@extends('layouts.app')

@section('styles')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>

    <!-- Esri Leaflet Geocoder -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"
    />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.min.css" integrity="sha512-sC2S9lQxuqpjeJeom8VeDu/jUJrVfJM7pJJVuH9bqrZZYqGe7VhTASUb3doXVk6WtjD0O4DTS+xBx2Zpr1vRvg==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" />

@endsection

@section('content')


@foreach($nuevas_tareas->ofertas as $oferta)

    {{ $oferta->respuestas }}

@endforeach

    <div class="container">

        <div class="row row-principal @if(count(Auth::user()->tareas) > 0) d-none @endif">

            <div class="col-12 text-center mt-5">

                <h3 class="text-center">No tienes tareas para mostrar.</h3>

                <a href="#" class="btn btn-principal w-25 mx-auto mt-5" data-toggle="modal" data-target="#modalPublicar">Agrega una tarea</a>

            </div>

        </div>

        <div class="row row-principal @if(count(Auth::user()->tareas) == 0) d-none @endif">

            <div class="col-12 col-md-4 lista-tareas">

                <div class="tareas">

                    @foreach(Auth::user()->tareas as $tarea)

                        @if(Request::input('tarea_id'))

                            @if(Request::input('tarea_id') == $tarea->id)

                                @php

                                    $tarea_actual = $tarea;

                                @endphp

                            @endif

                        @endif

                        <div
                            id="tarea"
                            id_tarea="{{ $tarea->id }}"
                            class="tarea
                                    @if($tarea->estatus === 'activa') border-activa
                                        @if(Request::input('tarea_id') == $tarea->id)borde-activa-completo @endif
                                    @elseif($tarea->estatus == 'asignada') border-asignada
                                        @if(Request::input('tarea_id') == $tarea->id)borde-asignada-completo @endif
                                    @elseif($tarea->estatus == 'concluida') border-concluida
                                        @if(Request::input('tarea_id') == $tarea->id)borde-concluida-completo @endif
                                    @elseif($tarea->estatus == 'expirada') border-expirada
                                        @if(Request::input('tarea_id') == $tarea->id)borde-expirada-completo @endif
                                    @endif"
                        >

                            <p class="tipo_tarea">{{ $tarea->nombre }}</p>

                            <div class="row tarea_conjunto">

                                <div class="col-3 mr-0 pr-0">

                                    @if(Auth::user()->perfil->imagen != null)

                                        <img src="/storage/perfiles/imagenes/{{ Auth::user()->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-barra">

                                    @else

                                        <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil" class="foto-perfil-barra">

                                    @endif

                                </div>

                                <div class="col-6 mr-0 ml-0 pr-0 pl-0">

                                    <p class="descripcion">{{ Str::limit(strip_tags($tarea->descripcion),40) }}</p>

                                </div>

                                <div class="col-3 mr-0 ml-0 pr-0 pl-0 ">

                                    <p class="precio">${{ $tarea->presupuesto }}</p>

                                </div>

                            </div>

                            <div class="direccion">

                                <i class="fas fa-map-marker-alt"></i>

                                <p>{{ $tarea->direccion }} {{ $tarea->colonia }}</p>

                            </div>

                            <div class="estrellas">

                                <i class="fas fa-calendar-alt"></i>

                                @php

                                    $fecha = $tarea->fecha_de_vencimiento;

                                @endphp

                                <mostrar-fecha fecha="{{ $fecha }}"></mostrar-fecha>

                            </div>

                        </div>

                    @endforeach

                </div>


            </div>

            <div class="col-12 col-md-8 descripcion-tarea lista-tareas">

                @if(!Request::input('tarea_id') )

                    @php

                        $tarea_actual = Auth::user()->tareas->first();

                    @endphp

                @endif

                @if(count(Auth::user()->tareas) > 0)

                    <div class="row">

                        <div class="col-12 col-md-8">

                            <div class="estado-trato">

                                @if($tarea_actual->estatus === 'activa')

                                    <span class="badge badge-pill badge-success">Disponible</span>

                                    <span class="badge badge-pill badge-secondary">Asignado</span>

                                    <span class="badge badge-pill badge-secondary">Concluido</span>

                                @elseif($tarea_actual->estatus === 'asignada')

                                    <span class="badge badge-pill badge-secondary">Disponible</span>

                                    <span class="badge badge-pill badge-warning">Asignado</span>

                                    <span class="badge badge-pill badge-secondary">Concluido</span>

                                @elseif($tarea_actual->estatus === 'concluida')

                                    <span class="badge badge-pill badge-secondary">Disponible</span>

                                    <span class="badge badge-pill badge-secondary">Asignado</span>

                                    <span class="badge badge-pill badge-danger">Concluido</span>

                                @elseif($tarea_actual->estatus === 'expirada')

                                    <span class="badge badge-pill badge-secondary">Disponible</span>

                                    <span class="badge badge-pill badge-secondary">Asignado</span>

                                    <span class="badge badge-pill badge-secondary">Concluido</span>

                                    <span class="badge badge-pill badge-danger">Expirado</span>

                                @endif

                            </div>

                            <h3 class="tarea-titulo">

                                {{ $tarea_actual->nombre }}

                            </h3>

                            <div class="tarea-autor">

                                <div class="publicador d-flex">

                                    @if(Auth::user()->perfil->imagen != null)

                                        <img src="/storage/perfiles/imagenes/{{ Auth::user()->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-barra">

                                    @else

                                        <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil" class="foto-perfil-barra">

                                    @endif

                                    <div>

                                        <p class="tarea-publicado-por">Publicado por</p>

                                        <a class="tarea-autor-publicado" href="{{ route('perfil.show', ['perfil' => Auth::user()->perfil->id ])}}" class="tarea-img">{{ Auth::user()->name }}</a>

                                    </div>

                                </div>

                                <div class="tarea-tiempo">

                                    <p>{{ $tarea_actual->created_at->diffForHumans() }}</p>

                                </div>

                            </div>

                            <hr>

                            <div class="ubicacion d-flex justify-content-between">

                                <div class="publicador d-flex">

                                    <i class="fas fa-map-marker-alt"></i>

                                    <div class="">
                                        <p class="tarea-publicado-por">Ubicación</p>
                                        <p class="direccion">{{ $tarea_actual->direccion }}</p>
                                        <p class="direccion">{{ $tarea_actual->colonia }} {{ $tarea_actual->estado->nombre }} </p>
                                        <p class="d-none" id="tarea-actual-lat">{{ $tarea_actual->lat }}</p>
                                        <p class="d-none" id="tarea-actual-lng">{{ $tarea_actual->lng }}</p>
                                        <span class="badge badge-pill badge-secondary">{{ ucfirst($tarea_actual->tipo) }}</span>
                                    </div>

                                </div>

                                <div class="ver-mapa d-flex flex-column ">

                                    {{-- @if($tarea_actual->lat != null || $tarea_actual->lat != '' && $tarea_actual->lng != null || $tarea_actual->lng != '')

                                        <a class="mapa text-center mb-2" href="https://www.google.com/maps/{{ $tarea_actual->lat }},{{ $tarea_actual->lng }}z" target="_blank">Ver Mapa</a>

                                    @endif --}}

                                    <a href="#" class="btn-editar2 mx-auto" data-toggle="modal" data-target="#modalUbicacion"><i class="fas fa-pen"></i></a>

                                </div>

                            </div>

                            <notificacion-sweet colonia={{ $tarea_actual->colonia }} lat={{ $tarea_actual->lat }} lng={{ $tarea_actual->lng }}></notificacion-sweet>


                            <hr>

                            <div class="ubicacion">

                                <div class="publicador d-flex">

                                    <i class="fas fa-calendar-alt"></i>

                                    <div>
                                        <p class="tarea-publicado-por">Fecha de vencimiento</p>

                                        @php

                                            $fecha = $tarea_actual->fecha_de_vencimiento;

                                        @endphp

                                        <mostrar-fecha fecha="{{ $fecha }}" class="fecha-vencimiento"></mostrar-fecha>

                                    </div>

                                </div>

                                <div class="d-flex justify-content-end mr-2">

                                    <a href="#" class="btn-editar2" data-toggle="modal" data-target="#modalFecha"><i class="fas fa-pen"></i></a>

                                </div>

                            </div>

                            <hr>

                        </div>

                        <div class="col-12 col-md-4">

                            <div class="presupuesto">

                                <p>Presupuesto</p>

                                <hr>

                                <p class="presupuesto-precio">${{ $tarea_actual->presupuesto }}</p>


                            </div>

                            <div class="d-flex justify-content-end mr-2" style="margin-top: -50px">

                                <a href="#" class="btn-editar2" data-toggle="modal" data-target="#modalPresupuesto"><i class="fas fa-pen"></i></a>

                            </div>

                            <div class="compartir-trato">

                                <div class="compartir-titulo">

                                    <p>Compartir</p>

                                </div>

                                <div class="compartir-redes">

                                    <a href="#" class="tweeter"><i class="fab fa-twitter"></i></a>

                                    <a href="#" class="facebook"><i class="fab fa-facebook"></i></a>

                                    <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>

                                </div>

                            </div>

                            <eliminar-tarea tarea-id={{ $tarea_actual->id }}></eliminar-tarea>

                        </div>


                        <div class="col-12 detalles">

                            <div class="d-flex justify-content-between">

                                <p class="detalles-trato">Detalles</p>

                                <div class="d-flex justify-content-end mr-2">

                                    <a href="#" class="btn-editar2" id="btn-detalles"><i class="fas fa-pen"></i></a>

                                </div>

                            </div>

                            <div class="detalles-contenido">

                                <p class="parrafo">{!! $tarea_actual->descripcion !!}</p>

                                @if(count($tarea_actual->imagenes) > 0)

                                    <ul class="list-unstyled mt-4 row">

                                        @foreach($tarea_actual->imagenes as $imagen)

                                            <li class="col-md-4 mb-4">

                                                <a href="/storage/{{ $imagen->ruta_imagen }}" data-lightbox="imagenes" data-title="Imagen descriptiva">

                                                    <img src="/storage/{{ $imagen->ruta_imagen }}" alt="" class="img-fluid">

                                                </a>

                                                <input type="hidden" class="galeria" value="{{ $imagen->ruta_imagen }}">

                                            </li>

                                        @endforeach

                                    </ul>

                                @endif

                            </div>

                            <div class="detalles-extra d-none">

                                <form action="{{ route('tarea.update', ['tarea' => $tarea_actual->id])}}" method="POST">
                                    @csrf
                                    @method('put')

                                    <div class="form-group">

                                        <label for="descripcion" class="mb-3">Sé lo mas específico que puedas con los detalles. Si es necesario puedes incluir imagenes.</label>

                                        <input id="descripcion"  type="hidden" name="descripcion" value="{{ $tarea_actual->descripcion }}">

                                        <trix-editor input="descripcion" style="min-height:200px;" class=" @error('descripcion') is-invalid @endif"></trix-editor>

                                        @error('descripcion')

                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>

                                        @enderror

                                    </div>

                                    <div class="form-group">

                                        <label for="imagenes">Imagenes</label>

                                        <div id="dropzone" class="dropzone rounded"></div>

                                        <input type="hidden" id="id_tarea" value="{{ $tarea_actual->id }}">

                                    </div>

                                    <div class="text-center">

                                        <button type="button" class="btn btn-cancelar btn-cancelar-detalles">Cancelar</button>

                                        <button class="btn btn-guardar " type="submit">Guardar</button>

                                    </div>

                                </form>

                            </div>

                            <hr>

                        </div>

                        <div class="col-12 ofertas-trato mt-5">

                            <p class="detalles-trato">ofertas</p>

                            @if(count($tarea_actual->ofertas) > 0)

                                @foreach($tarea_actual->ofertas as $oferta)

                                    <div class="oferta d-flex flex-column">

                                        <div class="">

                                            <img src="/storage/perfiles/imagenes/{{ $oferta->autor->perfil->imagen }}" alt="Imagen de perfil">

                                            <div class="d-flex flex-column text-left">

                                                <a href="{{ route('perfil.show', ['perfil' => $oferta->user_id]) }}">{{ $oferta->autor->name }}</a>

                                                <div class="estrellas">

                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    5.0
                                                </div>

                                            </div>

                                        </div>

                                        <div class="oferta-descripcion">

                                            <p class="parrafo">{{ $oferta->contenido }}</p>

                                            <div class="oferta-footer d-flex justify-content-between w-100">

                                                <p class="m-0">{{$oferta->created_at->diffForHumans()}}</p>

                                                <div>

                                                    {{-- <respuesta-oferta  autor={{ $oferta->autor->name }} oferta-contenido={{ $oferta->contenido }} oferta-id={{ $oferta->id }} imagen={{ $oferta->autor->perfil->imagen }} oferta-id-principal={{ $oferta->id}}></respuesta-oferta> --}}

                                                    @if(Auth::user()->id == $oferta->autor->id)

                                                        <button class="btn btn-sm btn-oferta-respuesta" ><i class="fas fa-trash-alt"></i></button>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>


                                        @if($oferta->respuestas)

                                            @foreach ($oferta->respuestas as $respuesta)

                                                <div class="oferta mb-0 pb-0 mt-0 pt-0">
                                                    <div class="oferta-descripcion w-75 float-right  text-left">

                                                        <img src="/storage/perfiles/imagenes/{{ $respuesta->autor->perfil->imagen }}" alt="Imagen de perfil">

                                                        <a class="" href="{{ route('perfil.show', ['perfil' => $respuesta->autor->id]) }}">{{ $respuesta->autor->name }}</a>

                                                        <p class="parrafo">{{ $respuesta->contenido }}</p>

                                                        @if($respuesta->imagen != null)

                                                            <a href="/storage/{{ $respuesta->imagen }}" data-lightbox="{{ $respuesta->imagen }}" data-title="Imagen descriptiva">

                                                                <img src="/storage/{{ $respuesta->imagen }}" alt="" class="img-fluid">

                                                            </a>

                                                        @endif

                                                        <div class="oferta-footer d-flex justify-content-between w-100">

                                                            <p class="m-0">{{$respuesta->created_at->diffForHumans()}}</p>

                                                            <div>

                                                                {{-- <button class="btn btn-sm btn-oferta-respuesta" respuesta_id={{ $respuesta->id}} autor="{{ $respuesta->autor->name }}" oferta_contenido="{{ $respuesta->contenido }}" oferta_id="{{ $respuesta->oferta->id }}" imagen="{{ $respuesta->autor->perfil->imagen }}"><i class="fas fa-reply"></i>Responder</button> --}}

                                                                {{-- <respuesta-oferta respuesta-id={{ $respuesta->id}} autor={{ $respuesta->autor->name }} oferta-contenido={{ $respuesta->contenido }} oferta-id={{ $respuesta->oferta->id }} imagen={{ $respuesta->autor->perfil->imagen }}></respuesta-oferta> --}}

                                                                @if(Auth::user()->id == $respuesta->autor->id)

                                                                    <eliminar-respuesta-oferta respuesta-oferta-id={{ $respuesta->id}}></eliminar-respuesta-oferta>

                                                                @endif

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            @endforeach

                                        @endif

                                    </div>

                                    <hr>

                                @endforeach

                                @include('ui.modalRespuestaOferta')

                            @else

                                <img class="imagen-ofertas" src="{{ asset('storage/img/ofertas.png') }}" alt="Imagen de ofertas">

                                <p class="parrafo text-center">Aún no hay ofertas para esta tarea.</p>

                                <hr>

                            @endif

                        </div>

                        <div class="col-12 mt-5 ofertas-trato">

                            <p class="detalles-trato">Preguntas</p>

                            @if(count($tarea_actual->preguntas) > 0)

                                @foreach($tarea_actual->preguntas as $pregunta)

                                    <div class="oferta d-flex flex-column">

                                        <div class="">

                                            <img src="/storage/perfiles/imagenes/{{ $pregunta->autor->perfil->imagen }}" alt="Imagen de perfil">

                                            <div class="d-flex flex-column text-left">

                                                <a href="{{ route('perfil.show', ['perfil' => $pregunta->user_id]) }}">{{ $pregunta->autor->name }}</a>

                                            </div>

                                        </div>

                                        <div class="oferta-descripcion">

                                            <p class="parrafo">{{ $pregunta->contenido }}</p>

                                            <div class="oferta-footer d-flex justify-content-between w-100">

                                                <p class="m-0">{{$pregunta->created_at->diffForHumans()}}</p>

                                                <div>

                                                    <button
                                                        class="btn btn-sm btn-pregunta-respuesta"
                                                        pregunta_id_principal={{ $pregunta->id }}
                                                        autor="{{ $pregunta->autor->name }}"
                                                        respuesta_contenido="{{ $pregunta->contenido }}"
                                                        respuesta_id="{{ $pregunta->id }}"
                                                        imagen="{{ $pregunta->autor->perfil->imagen }}">

                                                        <i class="fas fa-reply"></i>Responder

                                                    </button>

                                                    @if(Auth::user()->id == $pregunta->autor->id)

                                                        <button class="btn btn-sm btn-pregunta-respuesta" ><i class="fas fa-trash-alt"></i></button>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>


                                        @if($pregunta->respuestas)

                                            @foreach ($pregunta->respuestas as $respuesta)

                                                <div class="oferta mb-0 pb-0 mt-0 pt-0">
                                                    <div class="oferta-descripcion w-75 float-right  text-left">

                                                        <img src="/storage/perfiles/imagenes/{{ $respuesta->autor->perfil->imagen }}" alt="Imagen de perfil">

                                                        <a class="" href="{{ route('perfil.show', ['perfil' => $respuesta->autor->id]) }}">{{ $respuesta->autor->name }}</a>

                                                        <p class="parrafo">{{ $respuesta->contenido }}</p>

                                                        @if($respuesta->imagen != null)

                                                            <a href="/storage/{{ $respuesta->imagen }}" data-lightbox="{{ $respuesta->imagen }}" data-title="Imagen descriptiva">

                                                                <img src="/storage/{{ $respuesta->imagen }}" alt="" class="img-fluid">

                                                            </a>

                                                        @endif

                                                        <div class="oferta-footer d-flex justify-content-between w-100">

                                                            <p class="m-0">{{$respuesta->created_at->diffForHumans()}}</p>

                                                            <div>
                                                                <button
                                                                    class="btn btn-sm btn-pregunta-respuesta"
                                                                    respuesta_id={{ $respuesta->id}}
                                                                    autor="{{ $respuesta->autor->name }}"
                                                                    respuesta_contenido="{{ $respuesta->contenido }}"
                                                                    respuesta_id="{{ $respuesta->id }}"
                                                                    pregunta_id="{{ $respuesta->pregunta->id }}"
                                                                    imagen="{{ $respuesta->autor->perfil->imagen }}">


                                                                    <i class="fas fa-reply"></i>Responder

                                                                </button>

                                                                @if(Auth::user()->id == $respuesta->autor->id)

                                                                   {{--  <eliminar-pregunta-oferta respuesta-pregunta-id={{ $respuesta->id}}></eliminar-pregunta-oferta> --}}

                                                                @endif

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            @endforeach

                                        @endif

                                    </div>

                                    <hr>

                                @endforeach

                                @include('ui.modalRespuestaPregunta')

                            @else

                                <img class="imagen-ofertas" src="{{ asset('storage/img/pregunta.png') }}" alt="Imagen de ofertas">

                                <p class="parrafo text-center">Aún no hay preguntas para esta tarea.</p>

                                <hr>

                            @endif

                        </div>

                    </div>

                    {{-- MODALES --}}

                    {{-- Modal ubicacion --}}
                    <div class="modal fade" id="modalUbicacion" aria-labelledby="modalUbicacion" aria-hidden="true">

                        <div class="modal-dialog" role="document">

                            <div class="row justify-content-center">

                                <div class="col-12">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5 class="modal-title" id="modalUbicacion">Actualiza los datos de la ubicación de tu tarea.</h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                <span aria-hidden="true">×</span>

                                            </button>

                                        </div>

                                        <div class="modal-body">

                                            <div class="input-group">

                                                <input type="text" class="form-control"  placeholder="Pon aquí tu dirección" aria-label="" aria-describedby="basic-addon1" id="formBuscador">

                                                <input type="hidden" id="tarea_estado" value="{{ $tarea_actual->estado }}">

                                                <div class="input-group-append">

                                                    <button class="btn btn-secondary" type="button" id="btnformBuscador"><i class="fas fa-search"></i></button>

                                                </div>

                                                <small class="text-secondary text-center">El asistente colocará una dirección aproximada ó arrasatre el pin en tu ubicación</small>
                                                <small class="text-secondary mb-3 text-center">Por ejemplo: Madero 456, Centro, Morelia</small>

                                            </div>

                                            <form action="{{ route('tarea.update', ['tarea' => $tarea_actual->id])}}" method="POST">
                                                @csrf
                                                @method('put')

                                                <div class="form-group">

                                                    <div class="mapa" id="mapa" style="height: 400px; width:100%;"></div>

                                                </div>



                                                <p class="informacion-ubicacion ">Confirma que los siguientes campos son correctos.</p>

                                                <div class="form-group">

                                                    <label for="direccion" class="">Dirección</label>

                                                    <div class="">
                                                        <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ $tarea_actual->direccion }}">

                                                        @error('direccion')

                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>

                                                            <span role="alert" class="invalid-feedback">

                                                                <strong>Asegurate que el pin este en la ubicación aproopiada.</strong>

                                                            </span>

                                                        @enderror

                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label for="colonia" class="">Colonia</label>

                                                    <div class="">
                                                        <input id="colonia" type="text" class="form-control @error('colonia') is-invalid @enderror" name="colonia" value="{{ $tarea_actual->colonia }}">

                                                        @error('colonia')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>

                                                            <span role="alert" class="invalid-feedback">

                                                                <strong>Asegurate que el pin este en la ubicación apropiada.</strong>

                                                            </span>
                                                        @enderror

                                                    </div>

                                                </div>

                                                <input type="hidden" id="lat" name="lat" value="{{ old('lat') }}">

                                                <input type="hidden" id="lng" name="lng" value="{{ old('lng') }}">

                                                <div class="text-center">

                                                    <button class="btn btn-guardar btn-block" type="submit">Guardar</button>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Modal fecha --}}
                    <div class="modal fade" id="modalFecha" aria-labelledby="modalFecha" aria-hidden="true">

                        <div class="modal-dialog" role="document">

                            <div class="row justify-content-center">

                                <div class="col-8">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5 class="modal-title" id="modalFecha">Actualiza la fecha de tu tarea.</h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                <span aria-hidden="true">×</span>

                                            </button>

                                        </div>

                                        <div class="modal-body">

                                            <form action="{{ route('tarea.update', ['tarea' => $tarea_actual->id])}}" method="POST">
                                                @csrf
                                                @method('put')

                                                <div class="form-group">

                                                    <label for="fecha_de_vencimiento">¿Cuando lo necesitas hecho?</label>

                                                    <input class="form-control @error('fecha_de_vencimiento') is-invalid @enderror" type="date" name="fecha_de_vencimiento" id="fecha_de_vencimiento" value="{{ $tarea_actual->fecha_de_vencimiento }}">

                                                    @error('fecha_de_vencimiento')

                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>

                                                    @enderror

                                                </div>

                                                <div class="text-center">

                                                    <button class="btn btn-guardar btn-block" type="submit">Guardar</button>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Modal Presupuesto --}}
                    <div class="modal fade" id="modalPresupuesto" aria-labelledby="modalPresupuesto" aria-hidden="true">

                        <div class="modal-dialog" role="document">

                            <div class="row justify-content-center">

                                <div class="col-8">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5 class="modal-title" id="modalPresupuesto">Actualiza el presupuesto de tu tarea.</h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                <span aria-hidden="true">×</span>

                                            </button>

                                        </div>

                                        <div class="modal-body">

                                            <form action="{{ route('tarea.update', ['tarea' => $tarea_actual->id])}}" method="POST">
                                                @csrf
                                                @method('put')

                                                <div class="form-group">

                                                    <label for="presupuesto">Ingresa tu presupuesto.</label>

                                                    <input class="form-control @error('presupuesto') is-invalid @enderror" type="number" min=0 name="presupuesto" id="presupuesto" value="{{ $tarea_actual->presupuesto }}">

                                                    @error('presupuesto')

                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>

                                                    @enderror

                                                </div>

                                                <div class="text-center">

                                                    <button class="btn btn-guardar btn-block" type="submit">Guardar</button>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

@endsection

@section('scripts')

    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin="">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js"
        integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q=="
        crossorigin="anonymous" defer>
    </script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet" defer></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" integrity="sha512-9WciDs0XP20sojTJ9E7mChDXy6pcO0qHpwbEJID1YVavz2H6QBz5eLoDD8lseZOb2yGT8xDNIV7HIe1ZbuiDWg==" crossorigin="anonymous" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" defer></script>

    @if ($errors->has('direccion') || $errors->has('colonia') || $errors->has('lat') || $errors->has('lng'))

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', () => {

            $('#modalUbicacion').modal({

                show: true

            });

            });

        </script>

    @endif

    @if ($errors->has('fecha_de_vencimiento'))

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', () => {

            $('#modalFecha').modal({

                show: true

            });

            });

        </script>

    @endif

    @if ($errors->has('presupuesto'))

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', () => {

            $('#modalPresupuesto').modal({

                show: true

            });

            });

        </script>

    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            $('#btn-detalles').on('click', function(){

                $('.detalles-contenido').addClass('d-none');
                $('.detalles').append($('.detalles-extra').removeClass('d-none'));

            });

            $('.btn-cancelar-detalles').on('click', function(){

                $('.detalles-extra').addClass('d-none');
                $('.detalles-contenido').removeClass('d-none');

            });

            document.addEventListener("trix-file-accept", event => {
                event.preventDefault()
            })

            /* Seleccionar tarea y actualizar pagina  */
            $('.tarea').on('click', function(){

                window.location.href = "mistareas" + "?tarea_id=" + this.getAttribute("id_tarea");

            });

            /* Respuesta pregunta */
            var btnPreguntaRespuesta = document.querySelectorAll('.btn-pregunta-respuesta');

            for(const btn of btnPreguntaRespuesta){

                btn.addEventListener('click', function(){

                    var imagen = this.getAttribute('imagen');
                    var pregunta_contenido = this.getAttribute('respuesta_contenido');
                    var pregunta_id = this.getAttribute('pregunta_id_principal');

                    if(pregunta_id == null)
                        var pregunta_id = this.getAttribute('pregunta_id');

                    var autor = this.getAttribute('autor');

                    $('#modalRespuestaPregunta').on('show.bs.modal', function(){

                        $(this).find('#imagen-pregunta-respuesta').attr("src", "/storage/perfiles/imagenes/" + imagen);


                        $(this).find('#perfil-pregunta-respuesta').text(autor);
                        $(this).find('#pregunta_id_respuesta').val(pregunta_id);
                        $(this).find('#contenido-pregunta-respuesta').text(pregunta_contenido);
                    });

                    $('#modalRespuestaPregunta').modal({

                        show: true

                    })


                })

            }

        });

    </script>

    @if ($errors->has('descripcion'))

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', () => {

                $('.detalles-contenido').addClass('d-none');
                $('.detalles').append($('.detalles-extra').removeClass('d-none'));

            });

        </script>

    @endif

@endsection
