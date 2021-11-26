@extends('layouts.app')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" />

@endsection


@section('content')

    <div class="container">

        <div class="row-principal row-height-fix">

            <div class="col-12">

                <h1 class="titulo-publicar">Notificaciones de Preguntas</h1>

                @if(count($notificaciones_nuevas) > 0)

                    <h2 class="notificaciones-subtitulo">Preguntas Nuevas</h2>

                    <ul class="pl-0 mt-3">

                        @foreach ($notificaciones_nuevas as $notificacion)

                            @php
                                $data = $notificacion->data;
                            @endphp

                            <li class="notificacion mb-2 p-2">

                                <div class="d-flex justify-content-between align-items-center">

                                    <p class="notificacion-tarea-nombre">{{ $data['tarea_nombre'] }}</p>

                                    <a href="{{ route('tarea.tareas', ['tarea_id' => $data['tarea_id']]) }}" class="btn-siguiente mr-3">Ver Tarea</a>

                                </div>

                                <div class="oferta d-flex mb-0 pl-0 pr-0 pb-0">

                                    <div>

                                        @if($data['pregunta_autor_foto'] != null)

                                            <img src="/storage/perfiles/imagenes/{{ $data['pregunta_autor_foto'] }}" alt="Foto Perfil">

                                        @else

                                            <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil">

                                        @endif

                                    </div>

                                    <div class="oferta-descripcion w-100">

                                        <a href="{{ route('perfil.show', ['perfil' => $data['pregunta_autor_id']]) }}">{{ $data['pregunta_autor'] }}</a>

                                        <p class="parrafo">{{ $data['pregunta_contenido'] }}</p>

                                        @if($data['pregunta_imagen'] != null)

                                        <a href="/storage/preguntas/{{ $data['pregunta_imagen']}}" data-lightbox="notificacion.imagen{{ $data['tarea_id'] }}" data-title="Imagen descriptiva">

                                                <img src="/storage/preguntas/{{ $data['pregunta_imagen']}}" alt="" class="img-fluid">

                                            </a>

                                        @endif

                                    </div>

                                </div>

                            </li>

                        @endforeach

                    </ul>

                @else

                    <h3 class="notificaciones-subtitulo text-center">No hay notificaciones nuevas.</h3>

                @endif

                @if(count($notificaciones_anteriores) > 0)

                <h2 class="notificaciones-subtitulo">Preguntas Anteriores</h2>

                    <ul class="pl-0 mt-3">

                        @foreach ($notificaciones_anteriores as $notificacion)

                            @php
                                $data = $notificacion->data;
                            @endphp

                            @if($notificacion->read_at !== null)

                                <li class="notificacion mb-2 p-2">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <p class="notificacion-tarea-nombre">{{ $data['tarea_nombre'] }}</p>

                                        <a href="{{ route('tarea.tareas', ['tarea_id' => $data['tarea_id']]) }}" class="btn-siguiente mr-3">Ver Tarea</a>

                                    </div>

                                    <div class="oferta d-flex mb-0 pl-0 pr-0 pb-0">

                                        <div>

                                            @if($data['pregunta_autor_foto'] != null)

                                                <img src="/storage/perfiles/imagenes/{{ $data['pregunta_autor_foto'] }}" alt="Foto Perfil">

                                            @else

                                                <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil">

                                            @endif

                                        </div>

                                        <div class="oferta-descripcion w-100">

                                            <a href="{{ route('perfil.show', ['perfil' => $data['pregunta_autor_id']]) }}">{{ $data['pregunta_autor'] }}</a>

                                            <p class="parrafo">{{ $data['pregunta_contenido'] }}</p>

                                            @if($data['pregunta_imagen'] != null)

                                            <a href="/storage/preguntas/{{ $data['pregunta_imagen']}}" data-lightbox="notificacion.imagen{{ $data['tarea_id'] }}" data-title="Imagen descriptiva">

                                                    <img src="/storage/preguntas/{{ $data['pregunta_imagen']}}" alt="" class="img-fluid">

                                                </a>

                                            @endif

                                        </div>

                                    </div>

                                </li>

                            @else

                            @endif



                        @endforeach

                    </ul>

                @endif

            </div>

        </div>

    </div>

@endsection


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" defer></script>

@endsection
