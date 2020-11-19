<template>

    <div class="">

        <div class="row pr-3 ml-1">

            <div class="col-12 col-md-8">

                <div class="estado-trato">

                    <span class="badge badge-pill badge-success">Disponible</span>

                    <span class="badge badge-pill badge-secondary">Asignado</span>

                    <span class="badge badge-pill badge-secondary">Concluido</span>

                </div>

                <h3 class="tarea-titulo">

                    {{ tarea.nombre }}

                </h3>

                <div class="tarea-autor">

                    <div class="publicador d-flex">

                        <img v-if="tarea.usuario.perfil.imagen != null" :src="`/storage/perfiles/imagenes/${tarea.usuario.perfil.imagen}`"  alt="Foto Perfil" class="foto-perfil-barra">

                        <img v-else src="/storage/img/usuario.jpg"  alt="Foto Perfil" class="foto-perfil-barra">


                        <div>

                            <p class="tarea-publicado-por">Publicado por</p>

                            <a class="tarea-autor-publicado" :href="`/perfil/${tarea.usuario.id}`" >{{ tarea.usuario.name }}</a>

                        </div>

                    </div>

                    <div class="tarea-tiempo">

                        <p>{{ tarea.createdAtHumanReadable }}</p>

                    </div>

                </div>

                <hr>

                <div class="ubicacion d-flex justify-content-between">

                    <div class="publicador d-flex">

                        <i class="fas fa-map-marker-alt"></i>

                        <div class="">
                            <p class="tarea-publicado-por">Ubicación</p>
                            <p class="direccion">{{ tarea.direccion }}</p>
                            <p class="direccion">{{ tarea.colonia }} {{ tarea.estado.nombre }} </p>
                            <span class="badge badge-pill badge-secondary">{{ tarea.tipo | uppercase }}</span>
                        </div>

                    </div>

                </div>

                <hr>

                <div class="ubicacion">

                    <div class="publicador d-flex">

                        <i class="fas fa-calendar-alt"></i>

                        <div>
                            <p class="tarea-publicado-por">Fecha de vencimiento</p>

                            <mostrar-fecha :fecha="tarea.fecha_de_vencimiento" class="fecha-vencimiento"></mostrar-fecha>

                        </div>

                    </div>

                </div>

                <hr>

            </div>

            <div class="col-12 col-md-4">

                <div class="presupuesto">

                    <p>Presupuesto</p>

                    <hr>

                    <p class="presupuesto-precio">${{ tarea.presupuesto }}</p>

                    <hacer-oferta :tarea_id="tarea.id"></hacer-oferta>

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

            </div>

            <div class="col-12 detalles">

                <div class="d-flex justify-content-between">

                    <p class="detalles-trato">Detalles</p>

                </div>

                <div class="detalles-contenido">

                    <p class="parrafo" v-html="tarea.descripcion"></p>

                    <ul class="row list-unstyled mt-4">

                        <li
                            v-for="imagen in tarea.imagenes"
                            v-bind:key="imagen.id"
                            class="col-md-4"
                        >
                            <a :href='`/storage/${imagen.ruta_imagen}`' data-lightbox="imagenes" data-title="Imagen Establecimiento">

                                <img :src='`/storage/${imagen.ruta_imagen}`' alt="Imagen Previa" class="mb-4 img-fluid ">

                            </a>

                        </li>

                    </ul>

                </div>

                <hr>

            </div>

            <div class="col-12 ofertas-trato mt-3" :contenedor_oferta="tarea.id">

                <p class="detalles-trato">ofertas</p>

                <div
                    v-for="oferta in ofertas"
                    v-bind:key="oferta.id"
                >

                    <div class="oferta d-flex flex-column" :oferta_principal="oferta.id">

                        <div class="">

                            <img v-if="oferta.autor.perfil.imagen != null" :src="`/storage/perfiles/imagenes/${ oferta.autor.perfil.imagen }`" alt="Imagen de perfil">

                            <img v-else src="/storage/img/usuario.jpg"  alt="Foto Perfil" class="foto-perfil-barra">

                            <div class="d-flex flex-column text-left">

                                <a href="#">{{ oferta.autor.name }}</a>

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

                        <div class="oferta-descripcion" >

                            <p class="parrafo">{{ oferta.contenido | strippedContent}}</p>

                            <img v-if="oferta.imagen != null" :src="`/storage/ofertas/${ oferta.imagen }`" alt="Imagen de perfil">

                            <div class="oferta-footer d-flex justify-content-between w-100">

                                <p class="">{{ oferta.createdAtHumanReadable }}</p>

                                <div>

                                    <respuesta-oferta v-if="user_id" :oferta="oferta" :oferta_principal="oferta.id" :user_id="user_id"></respuesta-oferta>

                                    <eliminar-oferta v-if="oferta.autor.id === user_id" :oferta-id="oferta.id"></eliminar-oferta>

                                </div>

                            </div>

                        </div>

                        <div
                            v-for="respuesta in oferta.respuestas"
                            v-bind:key="respuesta.id"
                            class="oferta mb-0 pb-0 mt-0 pt-0"
                        >

                            <div class="oferta-descripcion w-75 float-right  text-left" :respuesta_oferta_id="respuesta.id">

                                <img v-if="respuesta.autor.perfil.imagen" :src="`/storage/perfiles/imagenes/${ respuesta.autor.perfil.imagen }`" alt="Imagen de respuesta">

                                <img v-else src="/storage/img/usuario.jpg"  alt="Foto Perfil" class="foto-perfil-barra">

                                <a class="" :href="`/perfil/${respuesta.autor.id}`">{{ respuesta.autor.name }}</a>

                                <p v-if="respuesta.contenido" class="parrafo">{{respuesta.contenido | strippedContent}}</p>



                                <div v-if="respuesta.imagen != null">

                                    <a :href="`/storage/${ respuesta.imagen }`" :data-lightbox="respuesta.imagen" data-title="Imagen descriptiva">

                                        <img :src="`/storage/${ respuesta.imagen }`" alt="" class="img-fluid">

                                    </a>

                                </div>

                                <div class="oferta-footer d-flex justify-content-between w-100">

                                    <p class="m-0">{{ respuesta.createdAtHumanReadable }}</p>

                                    <div>

                                        <eliminar-respuesta-oferta v-if="respuesta.autor.id === user_id" :respuesta-oferta-id="respuesta.id"></eliminar-respuesta-oferta>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div v-if="cantidadOfertas === 0">

                    <img class="imagen-ofertas" src="/storage/img/ofertas.png" alt="Imagen de ofertas">

                    <p class="parrafo text-center">Aún no hay ofertas para esta tarea.</p>

                </div>

            </div>

            <div class="col-12 ml-1">
                <hr>
            </div>

            <div class="col-12 ofertas-trato mt-3" :contenedor_pregunta="tarea.id">

                <p class="detalles-trato">Preguntas</p>

                    <div v-if="cantidadPreguntas === 0">

                        <img class="imagen-ofertas" src="/storage/img/pregunta.png" alt="Imagen de ofertas">

                        <p class="parrafo text-center">Aún no hay preguntas para esta tarea.</p>

                    </div>

                    <hacer-pregunta></hacer-pregunta>

                    <div
                        v-for="pregunta in preguntas"
                        v-bind:key="pregunta.id"
                    >

                        <div class="oferta d-flex flex-column w-100" :pregunta_principal="pregunta.id">

                            <div class="">

                                <img v-if="pregunta.autor.perfil.imagen != null" :src="`/storage/perfiles/imagenes/${ pregunta.autor.perfil.imagen }`" alt="Imagen de perfil">

                                <img v-else src="/storage/img/usuario.jpg"  alt="Foto Perfil" class="foto-perfil-barra">

                                <div class="d-flex flex-column text-left">

                                    <a href="#">{{ pregunta.autor.name }}</a>

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

                            <div class="oferta-descripcion" >

                                <p class="parrafo">{{ pregunta.contenido }}</p>

                                <div class="oferta-footer d-flex justify-content-between w-100">

                                    <p class="">{{ pregunta.createdAtHumanReadable }}</p>

                                    <div>

                                        <respuesta-pregunta v-if="user_id" :pregunta="pregunta" :pregunta_principal="pregunta.id" :user_id="user_id"></respuesta-pregunta>

                                        <eliminar-pregunta v-if="pregunta.autor.id === user_id" :pregunta-id="pregunta.id"></eliminar-pregunta>

                                    </div>

                                </div>

                            </div>

                            <div
                                v-for="respuesta in pregunta.respuestas"
                                v-bind:key="respuesta.id"
                                class="oferta mb-0 pb-0 mt-0 pt-0"
                            >

                                <div class="oferta-descripcion w-75 float-right  text-left" :respuesta_pregunta_id="respuesta.id">

                                    <img v-if="respuesta.autor.perfil.imagen" :src="`/storage/perfiles/imagenes/${ respuesta.autor.perfil.imagen }`" alt="Imagen de respuesta">

                                    <img v-else src="/storage/img/usuario.jpg"  alt="Foto Perfil" class="foto-perfil-barra">

                                    <a class="" :href="`/perfil/${respuesta.autor.id}`">{{ respuesta.autor.name }}</a>

                                    <p class="parrafo">{{ respuesta.contenido }}</p>


                                    <div v-if="respuesta.imagen != null">

                                        <a :href="`/storage/${ respuesta.imagen }`" :data-lightbox="respuesta.imagen" data-title="Imagen descriptiva">

                                            <img :src="`/storage/${ respuesta.imagen }`" alt="" class="img-fluid">

                                        </a>

                                    </div>

                                    <div class="oferta-footer d-flex justify-content-between w-100">

                                        <p class="m-0">{{ respuesta.createdAtHumanReadable }}</p>

                                        <div>

                                            <eliminar-respuesta-pregunta v-if="respuesta.autor.id === user_id" :respuesta-pregunta-id="respuesta.id"></eliminar-respuesta-pregunta>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
            </div>

        </div>

    </div>

</template>

<script>

    import store from '../store'
    import MostrarFecha from './MostrarFecha'
    import HacerOferta from './HacerOferta'
    import RespuestaOferta from './RespuestaOferta'
    import EliminarOferta from './EliminarOferta'
    import{mapState, mapActions} from 'vuex'

    export default {
        store,
        components: {
            MostrarFecha, RespuestaOferta, EliminarOferta, HacerOferta
        },
        computed:{
            ...mapState(['tarea', 'ofertas','user_id', 'preguntas','cantidadOfertas', 'cantidadPreguntas'])
        },
        methods:{
        },
        filters: {
            strippedContent: function(string) {
                return string.replace(/<\/?[^>]+>/ig, " ");
            },
            uppercase: function(v) {
                return v.toUpperCase();
            }
        }
    }

</script>

<style>

</style>
