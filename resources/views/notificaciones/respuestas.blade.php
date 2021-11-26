@extends('layouts.app')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" />

@endsection


@section('content')

    <div class="container">

        <div class="row-principal row-height-fix">

            <div class="col-12 mb-5">

                <h1 class="titulo-publicar">Notificaciones de Respuestas</h1>

                @if(count($notificaciones_nuevas_respuestas_pregunta) + count($notificaciones_nuevas_respuestas_oferta) > 0)

                    <div class="row">

                        <div class="col-sm-12 col-md-6">

                            <h2 class="notificaciones-subtitulo">Respuestas Nuevas De Ofertas</h2>

                            @if(count($notificaciones_nuevas_respuestas_oferta) == 0)

                                <h3 class="notificaciones-subtitulo2">No hay nuevas respuestas</h3>

                            @endif

                            <ul class="pl-0 mt-3">

                                @foreach ($notificaciones_nuevas_respuestas_oferta as $notificacion)

                                    @php
                                        $data = $notificacion->data;
                                    @endphp

                                    <li class="notificacion mb-2 p-2">

                                        <div class="d-flex justify-content-between align-items-center">

                                            <p class="notificacion-tarea-nombre">{{ $data['tarea_nombre'] }}</p>

                                            <a href="{{ route('tarea.tareas', ['tarea_id' => $data['tarea_id']]) }}" class="btn-siguiente mr-3">Ver Tarea</a>

                                        </div>

                                        <div class="oferta d-flex mb-0 pl-0 pr-0 pb-0">

                                            <div class="oferta-descripcion w-100  mb-0">

                                                <div class="parrafo"><strong>Tu Oferta:</strong> {{ Str::limit(strip_tags($data['oferta_contenido']),40) }}</div>

                                            </div>

                                        </div>

                                        <div class="oferta d-flex mb-0 pl-0 pr-0 pb-0">

                                            <div class="oferta-descripcion w-100 mb-0">

                                                <div class="parrafo"><a href="{{ route('perfil.show', ['perfil' => $data['respuesta_oferta_autor_id']]) }}"><strong>{{ $data['respuesta_oferta_autor'] }}</strong></a>: {!! $data['respuesta_oferta_contenido'] !!}</div>

                                            </div>

                                        </div>

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                        <div class="col-sm-12 col-md-6">

                            <h2 class="notificaciones-subtitulo">Respuestas Nuevas De Preguntas</h2>

                            @if(count($notificaciones_nuevas_respuestas_pregunta) == 0)

                                <h3 class="notificaciones-subtitulo2">No hay nuevas respuestas</h3>

                            @endif

                            <ul class="pl-0 mt-3">

                                @foreach ($notificaciones_nuevas_respuestas_pregunta as $notificacion)

                                    @php
                                        $data = $notificacion->data;
                                    @endphp

                                    <li class="notificacion mb-2 p-2">

                                        <div class="d-flex justify-content-between align-items-center">

                                            <p class="notificacion-tarea-nombre">{{ $data['tarea_nombre'] }}</p>

                                            <a href="{{ route('tarea.tareas', ['tarea_id' => $data['tarea_id']]) }}" class="btn-siguiente mr-3">Ver Tarea</a>

                                        </div>

                                        <div class="oferta d-flex mb-0 pl-0 pr-0 pb-0">

                                            <div class="oferta-descripcion w-100  mb-0">

                                                <div class="parrafo"><strong>Tu Pregunta:</strong> {{ Str::limit(strip_tags($data['pregunta_contenido']),40) }}</div>

                                            </div>

                                        </div>

                                        <div class="oferta d-flex mb-0 pl-0 pr-0 pb-0">

                                            <div class="oferta-descripcion w-100 mb-0">

                                                <div class="parrafo"><a href="{{ route('perfil.show', ['perfil' => $data['respuesta_pregunta_autor_id']]) }}"><strong>{{ $data['respuesta_pregunta_autor'] }}</strong></a>: {!! $data['respuesta_pregunta_contenido'] !!}</div>

                                            </div>

                                        </div>

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                @else

                    <h3 class="notificaciones-subtitulo text-center">No hay notificaciones nuevas.</h3>

                @endif

            </div>

            <div class="col-12">

                @if(count($notificaciones_anteriores_nuevas_respuestas_pregunta) + count($notificaciones_anteriores_nuevas_respuestas_oferta) > 0)

                    <h2 class="notificaciones-subtitulo">Respuestas Anteriores</h2>

                    <div class="row">

                        <div class="col-sm-12 col-md-6">

                            <h2 class="notificaciones-subtitulo">Respuestas Anteriores De Ofertas</h2>

                            @if(count($notificaciones_anteriores_nuevas_respuestas_oferta) == 0)

                                <h3 class="notificaciones-subtitulo2">No hay respuestas</h3>

                            @endif

                            <ul class="pl-0 mt-3">

                                @foreach ($notificaciones_anteriores_nuevas_respuestas_oferta as $notificacion)

                                    @php
                                        $data = $notificacion->data;
                                    @endphp

                                    <li class="notificacion mb-2 p-2">

                                        <div class="d-flex justify-content-between align-items-center">

                                            <p class="notificacion-tarea-nombre">{{ $data['tarea_nombre'] }}</p>

                                            <a href="{{ route('tarea.tareas', ['tarea_id' => $data['tarea_id']]) }}" class="btn-siguiente mr-3">Ver Tarea</a>

                                        </div>

                                        <div class="oferta d-flex mb-0 pl-0 pr-0 pb-0">

                                            <div class="oferta-descripcion w-100  mb-0">

                                                <div class="parrafo"><strong>Tu Oferta:</strong> {{ Str::limit(strip_tags($data['oferta_contenido']),40) }}</div>

                                            </div>

                                        </div>

                                        <div class="oferta d-flex mb-0 pl-0 pr-0 pb-0">

                                            <div class="oferta-descripcion w-100 mb-0">

                                                <div class="parrafo"><a href="{{ route('perfil.show', ['perfil' => $data['respuesta_oferta_autor_id']]) }}"><strong>{{ $data['respuesta_oferta_autor'] }}</strong></a>: {!! $data['respuesta_oferta_contenido'] !!}</div>

                                            </div>

                                        </div>

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                        <div class="col-sm-12 col-md-6">

                            <h2 class="notificaciones-subtitulo">Respuestas Anteriores De Preguntas</h2>

                            @if(count($notificaciones_anteriores_nuevas_respuestas_pregunta) == 0)

                                <h3 class="notificaciones-subtitulo2">No hay respuestas</h3>

                            @endif

                            <ul class="pl-0 mt-3">

                                @foreach ($notificaciones_anteriores_nuevas_respuestas_pregunta as $notificacion)

                                    @php
                                        $data = $notificacion->data;
                                    @endphp

                                    <li class="notificacion mb-2 p-2">

                                        <div class="d-flex justify-content-between align-items-center">

                                            <p class="notificacion-tarea-nombre">{{ $data['tarea_nombre'] }}</p>

                                            <a href="{{ route('tarea.tareas', ['tarea_id' => $data['tarea_id']]) }}" class="btn-siguiente mr-3">Ver Tarea</a>

                                        </div>

                                        <div class="oferta d-flex mb-0 pl-0 pr-0 pb-0">

                                            <div class="oferta-descripcion w-100  mb-0">

                                                <div class="parrafo"><strong>Tu Pregunta:</strong> {{ Str::limit(strip_tags($data['pregunta_contenido']),40) }}</div>

                                            </div>

                                        </div>

                                        <div class="oferta d-flex mb-0 pl-0 pr-0 pb-0">

                                            <div class="oferta-descripcion w-100 mb-0">

                                                <div class="parrafo"><a href="{{ route('perfil.show', ['perfil' => $data['respuesta_pregunta_autor_id']]) }}"><strong>{{ $data['respuesta_pregunta_autor'] }}</strong></a>: {!! $data['respuesta_pregunta_contenido'] !!}</div>

                                            </div>

                                        </div>

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

@endsection


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" defer></script>

@endsection
