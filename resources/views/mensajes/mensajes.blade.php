@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row row-principal">

            @if( $mensajes == 0)

                <div class="col-12 text-center ">

                    <h3 class="text-center">No tienes mensajes para mostrar.</h3>

                </div>

            @else


                <div class="col-12 col-md-4 lista-tareas">

                    <div class="tareas">

                        @foreach($tareas as $tarea)

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
                                class="tarea mensaje
                                        @if(Request::input('tarea_id') == $tarea->id)mensaje-completo @endif
                                        @foreach($notificaciones as $notificacion)
                                            @php
                                                $data = $notificacion->data;
                                            @endphp
                                            @if($tarea->id === $data['tarea_id'])
                                                mensaje-completo
                                                @break
                                            @endif
                                        @endforeach
                                        "
                            >

                                <p class="tipo_tarea">{{ $tarea->nombre }}</p>

                                <div class="row tarea_conjunto">

                                    <div class="col-3 mr-0 pr-0">

                                        @if(Auth::user()->id === $tarea->usuario->id)

                                            @if($tarea->trabajadorAsignado->perfil->imagen)

                                                <img src="/storage/perfiles/imagenes/{{ $tarea->trabajadorAsignado->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-barra">

                                            @else

                                                <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil" class="foto-perfil-barra">

                                            @endif

                                        @else

                                            @if($tarea->usuario->perfil->imagen)

                                                <img src="/storage/perfiles/imagenes/{{ $tarea->usuario->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-barra">

                                            @else

                                                <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil" class="foto-perfil-barra">

                                            @endif

                                        @endif

                                    </div>

                                    <div class="col-9 mr-0 ml-0 pr-0 pl-0">

                                        <p class="descripcion">{{ Str::limit($tarea->mensajes->last()->contenido,50) }}</p>

                                    </div>

                                </div>

                                <div class="direccion">

                                    <i class="fas fa-user" style="color:#afc8ce;"></i>

                                    @if(Auth::user()->id === $tarea->usuario->id)

                                        <p>{{ $tarea->trabajadorAsignado->name }}</p>

                                    @else

                                        <p>{{ $tarea->usuario->name }}</p>

                                    @endif

                                </div>

                                <div class="estrellas">

                                    <i class="fas fa-calendar-alt" style="color:#afc8ce;"></i>

                                    {{ $tarea->mensajes->last()->createdAtHumanReadable }}

                                </div>

                            </div>

                        @endforeach

                    </div>


                </div>

                <div class="col-12 col-md-8 ">

                    @if(!Request::input('tarea_id') )

                        @php

                            $tarea_actual = $tareas->first();

                        @endphp

                    @endif

                    <div class="conversacion">

                        <div class="w-100">

                            @foreach($tarea_actual->mensajes as $mensaje)

                                @if($mensaje->autor == auth()->user()->id)

                                    <div class="mensaje-enviado w-100 d-flex justify-content-end mb-2">

                                        <div class="contenido">

                                            <p class="contenido-mensaje">{{ $mensaje->contenido }}</p>
                                            <p class="fecha">{{ $mensaje->createdAtHumanReadable }}</p>

                                        </div>

                                        @if($tarea_actual->trabajadorAsignado->perfil->imagen)

                                            <img src="/storage/perfiles/imagenes/{{ Auth::user()->find($mensaje->autor)->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-barra">

                                        @else

                                            <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil" class="foto-perfil-barra">

                                        @endif

                                    </div>

                                @else

                                    <div class="mensaje-recivido w-100 mb-2">

                                        @if($tarea_actual->usuario->id == $mensaje->autor)

                                            <img src="/storage/perfiles/imagenes/{{ $tarea_actual->usuario->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-barra">

                                        @else

                                            <img src="/storage/perfiles/imagenes/{{ $tarea_actual->trabajadorAsignado->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-barra">

                                        @endif

                                        <div class="contenido">

                                            <p class="contenido-mensaje">{{ $mensaje->contenido }}</p>
                                            <p class="fecha">{{ $mensaje->createdAtHumanReadable }}</p>

                                        </div>

                                    </div>

                                @endif

                            @endforeach

                        </div>
                    </div>

                    <div class="ingresar-mensaje">

                        <form class="w-100" id="mensajeForm" method="post">
                            @csrf

                            <div class="form-group">

                                <textarea class="form-control" id="contenido" name="contenido"  rows="2" placeholder="Escribe tu mensaje" style="resize: none;"></textarea>

                                <input type="hidden" id="tarea_id"  name="tarea_id" value="{{ $tarea_actual->id }}">

                                <input type="hidden" id="autor_id" name="autor_id"  value="{{ Auth::user()->id }}">

                            </div>

                            <button class="btn btn-enviar" type="submit">Enviar</button>

                        </form>

                    </div>

                </div>

            @endif

        </div>

    </div>

@endsection

@section('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            /* Acomodar area de mensajes para ve rel ultimo enviado */
            $('.conversacion').scrollTop($('.conversacion')[0].scrollHeight);

            /* Seleccionar mensaje y actualizar pagina  */
            $('.tarea').on('click', function(){

                window.location.href = "mensajes" + "?tarea_id=" + this.getAttribute("id_tarea");

            });



        });
    </script>

    @if($mensajes != 0)

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                /* Enviar mensaje */

                $('#mensajeForm').submit(function(e){

                    e.preventDefault();

                    let formData = $(this).serializeArray();

                    $.ajax({
                        method: "POST",
                        headers: {
                            Accept: "application/json"
                        },
                        url: "{{ route('enviar_mensaje') }}",
                        data: formData,
                        success: (response) =>{
                            /* console.log(response) */

                            html="<div class='mensaje-enviado w-100 d-flex justify-content-end'>"+
                                    "<div class='contenido'>" +
                                        "<p class='contenido-mensaje'>" + response.contenido + "</p>" +
                                        "<p class='fecha'>" + response.createdAtHumanReadable + "</p>" +
                                    "</div>" +
                                    "<img src='/storage/perfiles/imagenes/{{ Auth::user()->find($mensaje->autor)->perfil->imagen }}' alt='Foto Perfil' class='foto-perfil-barra'>"
                                "</div>";

                            $('.conversacion').append(html)
                            $('.conversacion').scrollTop($('.conversacion')[0].scrollHeight);
                        },
                        error: (response) => {
                            /* console.log(response) */
                        }
                    })
                });

            });

        </script>

    @endif

@endsection
