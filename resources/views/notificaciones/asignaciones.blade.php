@extends('layouts.app')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" />

@endsection

@section('content')

    <div class="container">

        <div class="row-principal row-height-fix">

            <div class="col-12 mb-5">

                <h1 class="titulo-publicar">Asignaciones</h1>

                @if(count($notificaciones_nuevas) > 0)

                    <h2 class="notificaciones-subtitulo">Asignaciones Nuevas</h2>

                    <ul class="pl-0 mt-3">

                        @foreach ($notificaciones_nuevas as $notificacion)

                            @php
                                $data = $notificacion->data;
                            @endphp

                            <li class="notificacion mb-2 p-2">

                                <div class="d-flex justify-content-between align-items-center">

                                    <p class="notificacion-tarea-nombre">{{ $data['tarea_autor_nombre'] }} te Asignó: {{ $data['tarea_nombre'] }}</p>

                                    <a href="{{ route('tarea.tareas', ['tarea_id' => $data['tarea_id']]) }}" class="btn-siguiente mr-3">Ver Tarea</a>

                                </div>

                                <div class="oferta d-flex mb-0 pl-0 pr-0 pb-0">

                                    <div class="oferta-descripcion w-100 mb-0">

                                        <p class="parrafo">{{ $data['tarea_contenido'] }}</p>

                                        <a href="#"class="btn-mensaje">Enviar un mensaje a {{ $data['tarea_autor_nombre'] }}</a>

                                    </div>

                                </div>

                            </li>

                        @endforeach

                    </ul>

                @else

                    <h3 class="notificaciones-subtitulo text-center">No hay notificaciones nuevas.</h3>

                @endif

            </div>



                <div class="row">

                    <div class="col-sm-12 col-md-6">

                        <h2 class="notificaciones-subtitulo">Tareas que se te han asignado</h2>

                        @if(count($tareas_asignadas) > 0)


                            <ul class="pl-0 mt-3">

                                @foreach($tareas_asignadas->reverse() as $tarea)

                                    <li class="notificacion mb-2 p-2">

                                        <div class="d-flex justify-content-between align-items-center">

                                            <p class="notificacion-tarea-nombre">{{ $tarea->usuario->name }} te Asignó: {{ $tarea->nombre }}</p>

                                            <a href="{{ route('tarea.tareas', ['tarea_id' => $tarea->id]) }}" class="btn-siguiente mr-3">Ver Tarea</a>

                                        </div>

                                        <div class="oferta d-flex mb-0 pl-0 pr-0 pb-0">

                                            <div class="oferta-descripcion w-100 mb-0">

                                                <p class="parrafo">{{ $tarea->descripcion }}</p>

                                                <enviar-mensaje tarea_id="{{$tarea->id}}" nombre="{{ $tarea->usuario->name}}" id="{{ Auth::user()->id }}"></enviar-mensaje>

                                            </div>

                                        </div>

                                    </li>

                                @endforeach

                            </ul>

                        @else

                            <h3 class="notificaciones-subtitulo2">No hay asignaciones</h3>

                        @endif

                    </div>

                    <div class="col-sm-12 col-md-6">

                        <h2 class="notificaciones-subtitulo">Tareas que has asignado</h2>

                        @if(count($tareas) > 0)

                            <ul class="pl-0 mt-3">

                                @foreach($tareas->reverse() as $tarea)

                                    <li class="notificacion mb-2 p-2">

                                        <div class="d-flex justify-content-between align-items-center">

                                            <p class="notificacion-tarea-nombre">Asignaste: {{ $tarea->nombre }} a {{ $tarea->trabajadorAsignado->name }}</p>

                                            <a href="{{ route('tarea.mistareas', ['tarea_id' => $tarea->id]) }}" class="btn-siguiente mr-3">Ver Tarea</a>

                                        </div>

                                        <div class="oferta d-flex mb-0 pl-0 pr-0 pb-0">

                                            <div class="oferta-descripcion w-100 mb-0">

                                                <p class="parrafo">{{ $tarea->descripcion }}</p>

                                                {{-- <enviar-mensaje tarea_id="{{$tarea->id}}" nombre="{{ $tarea->trabajadorAsignado}}" id="{{ $tarea->trabajador }}"></enviar-mensaje> --}}
                                                <enviar-mensaje tarea_id="{{$tarea->id}}" nombre="{{ $tarea->trabajadorAsignado->name}}" id="{{ Auth::user()->id }}"></enviar-mensaje>
                                            </div>

                                        </div>

                                    </li>

                                @endforeach

                            </ul>

                        @else

                            <h3 class="notificaciones-subtitulo2">No hay asignaciones</h3>

                        @endif

                    </div>
                </div>


        </div>

    </div>

@endsection


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" defer></script>

@endsection
