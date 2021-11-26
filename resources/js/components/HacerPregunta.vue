<template>

    <div class="mb-3">

        <form @submit.prevent="hacerPregunta">

            <div class="form-group ml-1">

                <textarea class="form-control" rows="3" :placeholder="`Preguntale a ${tarea.usuario.name} lo que necesites saber acerca de la oferta.`" v-model="contenido" required></textarea>

            </div>

            <div class="d-flex justify-content-between">

                <div class="form-group mb-0">

                    <input type="file" ref="boton" class="d-none" @change="cargarImagenOferta($event)">

                    <button type="button" class="btn btn-guardar labela text-white ml-1 mb-1" @click="$refs.boton.click()"><i class="far fa-images"></i></button>

                </div>

                <button class="btn float-right btn-guardar">Enviar</button>

            </div>

        </form>

    </div>

</template>

<script>

    import {mapActions, mapState} from 'vuex'
    import store from '../store'

    export default {
        store,
        name: 'HacerPregunta',
        data() {
            return{
                contenido:null,
                imagenSubida:null
            }
        },
        computed:{
            ...mapState(['tarea','user_id', 'usuarioLogeado','cantidadPreguntas']),
        },
        methods:{
            hacerPregunta(){

                if(this.tarea.user_id === this.usuarioLogeado.id){
                    this.$swal({

                        title:"No puedes preguntar.",
                        icon:'error'

                    })
                    return;
                }

                if(this.user_id){
                    const formData = new FormData();

                    formData.append('contenido', this.contenido);
                    formData.append('tarea_id', this.tarea.id);
                    formData.append('user_id', this.user_id);

                    if(this.imagenSubida != null)
                        formData.append('imagen', this.imagenSubida);

                    axios.post('/api/pregunta', formData)
                        .then(response =>{
                            /* console.log(response); */
                            this.contenido = null;
                            this.imagenSubida= null;

                            if(this.cantidadPreguntas === 0)
                                this.$store.commit("CARGAR_CANTIDAD_PREGUNTAS", 1);

                            if(response.data.imagen){
                                $('div[contenedor_pregunta=' + this.tarea.id + ']').append(
                                    "<div class='temporal oferta d-flex flex-column' pregunta_principal=" + response.data.id + ">" +
                                        "<div>"+
                                            "<img src=" + `/storage/perfiles/imagenes/${ this.usuarioLogeado.perfil.imagen }` + " alt='Foto del usuario'>" +
                                            "<div class='d-flex flex-column text-left'>" +
                                                "<a href='#'>" + this.usuarioLogeado.name + "</a>" +
                                                "<div class='estrellas'>" +
                                                    "<i class='fas fa-star'></i>"+
                                                    "<i class='fas fa-star'></i>"+
                                                    "<i class='fas fa-star'></i>"+
                                                    "<i class='fas fa-star'></i>"+
                                                    "<i class='fas fa-star'></i>"+
                                                    "5.0" +
                                                "</div>" +
                                            "</div>" +
                                        "</div>" +
                                        "<div class='oferta-descripcion'>" +
                                            "<p class='parrafo'>" + response.data.contenido + "</p><br>" +
                                            "<a class='mt-2' href='/storage/preguntas/" + response.data.imagen + "' data-lightbox='" + response.data.imagen + "' data-title='Imagen descriptiva'>"+
                                                "<img src='/storage/preguntas/" + response.data.imagen + "'</img>"+
                                            "</a>"+
                                            "<div class='oferta-footer d-flex justify-content-between w-100'>" +
                                                "<p>" + response.data.createdAtHumanReadable + "</p>" +
                                                "<button class='btn btn-sm btn-eliminar-pregunta float-right' style='color: #aaaaaa;' id='"+ response.data.id +"'><i class='fas fa-trash-alt'></i></button>" +
                                            "</div>" +
                                        "</div>" +
                                    "</div>"
                                );
                            }else{
                                $('div[contenedor_pregunta=' + this.tarea.id + ']').append(
                                    "<div class='temporal oferta d-flex flex-column' pregunta_principal=" + response.data.id + ">" +
                                        "<div>"+
                                            "<img src=" + `/storage/perfiles/imagenes/${ this.usuarioLogeado.perfil.imagen }` + " alt='Foto del usuario'>" +
                                            "<div class='d-flex flex-column text-left'>" +
                                                "<a href='#'>" + this.usuarioLogeado.name + "</a>" +
                                                "<div class='estrellas'>" +
                                                    "<i class='fas fa-star'></i>"+
                                                    "<i class='fas fa-star'></i>"+
                                                    "<i class='fas fa-star'></i>"+
                                                    "<i class='fas fa-star'></i>"+
                                                    "<i class='fas fa-star'></i>"+
                                                    "5.0" +
                                                "</div>" +
                                            "</div>" +
                                        "</div>" +
                                        "<div class='oferta-descripcion'>" +
                                            "<p class='parrafo'>" + response.data.contenido + "</p>" +
                                            "<div class='oferta-footer d-flex justify-content-between w-100'>" +
                                                "<p>" + response.data.createdAtHumanReadable + "</p>" +
                                                "<button class='btn btn-sm btn-eliminar-pregunta float-right' style='color: #aaaaaa;' id='"+ response.data.id +"'><i class='fas fa-trash-alt'></i></button>" +
                                            "</div>" +
                                        "</div>" +
                                    "</div>"
                                );
                            }
                            /* console.log($('div[pregunta_principal=' + response.data.id + ']')) */
                            $('div[pregunta_principal=' + response.data.id + ']')[0].firstChild.scrollIntoView({behavior:'smooth'})

                        }).catch(error => {
                            /* console.log(error); */
                            this.contenido = null;
                            this.imagenSubida= null;

                            this.$swal({

                                title:"Hubo un error al hacer la oferta.",
                                icon:'error'

                            })
                        });
                }else{
                    $("#loginModal").modal('show');
                }

            },
            cargarImagenOferta(e){

                 const tipoArchivo = e.target.files[0].type;

                if(tipoArchivo === 'image/jpeg' || tipoArchivo === 'image/png'){
                    this.imagenSubida = e.target.files[0];
                    let show = "<span>" + e.target.files[0].name + "</span>";
                    let output = document.querySelector('.labela');
                    output.innerHTML = show;
                    output.classList.add("active");

                }else{
                    this.$swal({

                        title:"Formato no valido.",
                        icon:'error'

                    })
                    this.imagenSubida = null;
                    return;
                }
            }
        }
    }

</script>

<style scoped>

</style>
