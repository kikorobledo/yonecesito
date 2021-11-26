@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row-principal row-height-fix">

            <div class="col-8 mx-auto">

                <h1 class="titulo-publicar">Publica lo que necesitas y comienza a recibir propuestas</h1>

                <h2 class="subtitulo-publicar">En Yo necesito encontrarás especialistas que te ayudarán a completar esa tarea que necesitas completar, ya sea en persona o en línea.</h2>
            </div>


            <div class="col-8 mx-auto">

                <p class="seccion-titulo">Publica lo que necesitas y comienza a recibir propuestas</p>

                <div class="seccion">

                        <p class="seccion-subtitulo">Describe lo que necesitas</p>

                        <p class="seccion-descripcion">
                            Indica que tipo de tarea requieres completar, menciona cuándo requieres que se realice, dónde (localidad), modalidad (en persona o remoto) y sugiere un presupuesto acorde a la tarea solicitada.
                        </p>

                        <p class="seccion-descripcion">Puedes publicar cualquier tipo de tarea desde la limpieza de tu casa, la reparación de cualquier artefacto hasta diseños de páginas web.</p>

                        <p class="seccion-descripcion">Es gratis publicar una oferta, simplemente debes crear una cuenta y describirle a la comunidad tu necesidad.</p>

                        <p class="seccion-descripcion">En caso de que ninguna oferta de servicios te convenza no estás obligado a contratar.</p>

                        <div>
                            <a href="#" class="seccion-boton" data-toggle="modal" data-target="#modalPublicar">Publica lo que necesitas ahora</a>
                        </div>

                        <p class="seccion-subtitulo" >Recibe propuestas en minutos</p>

                        <p class="seccion-descripcion">
                            Inmediatamente los trabajadores leerán tu oferta y se postularán para el trabajo.
                        </p>

                </div>

            </div>

            <div class="col-8 mx-auto">

                <p class="seccion-titulo">Revisa las ofertas y selecciona al mejor postulante</p>

                <div class="seccion">

                    <p class="seccion-subtitulo">Revisa los perfiles de los postulantes</p>

                    <p class="seccion-descripcion">
                        Visualiza los perfiles de los candidatos, así como sus reseñas de trabajos anteriores para elegir al que te conviene más.
                    </p>

                </div>

            </div>

            <div class="col-8 mx-auto">

                <p class="seccion-titulo">Realiza el pago en forma segura con Yo necesito</p>

                <div class="seccion">

                    <p class="seccion-subtitulo"> </p>

                    <p class="seccion-descripcion">
                        Cuando aceptas una oferta, tu pago se mantiene seguro hasta que el trabajo sea completado. En este momento puedes ponerte en contacto con el trabajador y darle más detalles sobre la tarea.
                    </p>

                </div>

                <div class="row d-flex justify-content-center text-center mb-4">
                    <div class="col-4">

                        <i class="icono-publicar fas fa-shield-alt"></i>

                        <p class="icono-titulo">Depósito En Garantía</p>

                        <p class="icono-descripcion">Tú dinero resguardado hasta que decidas liberar los fondos al profesional.</p>

                    </div>

                    <div class="col-4">

                        <i class="icono-publicar fas fa-handshake"></i>

                        <p class="icono-titulo">Garantía De Cobro</p>

                        <p class="icono-descripcion">Si el profesional no realiza el tarea se te devuelve el dinero.</p>

                    </div>

                </div>

            </div>

            <div class="col-8 mx-auto">

                <p class="seccion-titulo">Busca trabajos que puedas desempeñar</p>

                <div class="seccion">

                    <p class="seccion-subtitulo">Crea tu perfil en Yo necesito</p>

                    <p class="seccion-descripcion">
                        Describe tus habilidades y en qué te especializas.
                    </p>

                    <p class="seccion-subtitulo">Busca tareas</p>

                    <p class="seccion-descripcion">
                        Conoce las necesidades de los ofertantes, el presupuesto y el tiempo con el que dispone.
                    </p>

                    <div>

                        @guest

                            <a href="#" class="seccion-boton" data-toggle="modal" data-target="#registerModal">Crea tu perfil y busca tareas</a>

                        @else

                            <a href="{{ route('perfil.edit', ['perfil' => Auth::user()->perfil->id]) }}" class="seccion-boton" >Crea tu perfil y busca tareas</a>

                        @endguest

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
