<template>

    <div class="">

        <button class="btn btn-sm btn-oferta-respuesta" @click="abrir"><i class="fas fa-reply"></i>Responder</button>

        <div v-if="myModel" class="w-100">

            <transition name="modal">

                <div class="modal-mask">

                    <div class="modal-wrapper w-100">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h4 class="modal-title mx-auto">Respuesta Oferta</h4>

                                    <button type="button" class="close float-right" @click="myModel=false"><span aria-hidden="true">&times;</span></button>

                                </div>

                                <div class="modal-body">

                                    <div class="mb-2">

                                        <img v-if="this.oferta.autor.perfil.imagen" :src="imagenAutor" alt="Imagen de perfil" id="imagen-oferta-respuesta">

                                        <img v-else src="/storage/img/usuario.jpg"  alt="Foto Perfil" class="foto-perfil-barra">

                                        <div class="d-flex flex-column text-left">

                                            <p class="mb-0 nombre-texto">{{ nombreAutor }}</p>

                                            <p class="contenido-texto">{{ contenido | strippedContent}}</p>

                                        </div>

                                    </div>

                                    <form @submit.prevent="responder" enctype="multipart/form-data">

                                        <div class="form-group w-100">

                                            <textarea name="contenido_respuesta_oferta"  rows="5" class="form-control" placeholder="Responde aquí" style="resize: none;" v-model="contenidoSubida"></textarea>

                                        </div>

                                        <div class="d-flex justify-content-between w-100">

                                            <div class="form-group">

                                                <input type="file" ref="boton" class="d-none" @change="cargarImagen($event)">

                                                <button type="button" class="btn btn-guardar labela text-white" @click="$refs.boton.click()"><i class="far fa-images"></i></button>

                                            </div>

                                            <div>

                                                <button class="btn btn-guardar btn-sm " type="submit">Responder</button>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </transition>

        </div>

    </div>

</template>

<script>

    export default {
        name:'RespuestaOferta',
        props:['oferta', 'oferta_principal', 'user_id'],
        data(){
            return{
                imagenAutor:'/storage/perfiles/imagenes/' + this.oferta.autor.perfil.imagen,
                nombreAutor: this.oferta.autor.name,
                contenido: this.oferta.contenido,
                imagenSubida:null,
                contenidoSubida:'',
                idmodal:'modal' + this.oferta_principal,
                myModel:false
            }
        },
        mounted() {
        },
        methods: {
            abrir(){

                this.myModel = true;
                this.contenidoSubida = '';
                this.imagenSubida = null;
                setTimeout(() => {
                    let output = document.querySelector('.labela');
                    output.innerHTML = '<i class="far fa-images text-white"></i>';
                }, 1000);

            },
            cargarImagen(e){

                this.imagenSubida = e.target.files[0];

                let show = "<span>" + e.target.files[0].name + "</span>";
                let output = document.querySelector('.labela');
                output.innerHTML = show;
                output.classList.add("active");

            },
            responder(){

                const formData = new FormData();

                formData.append('contenido_respuesta_oferta', this.contenidoSubida);

                formData.append('oferta_id', this.oferta_principal);

                formData.append('user_id', this.user_id);

                if(this.imagenSubida != null)
                    formData.append('imagen-respuesta-oferta', this.imagenSubida);

                axios.post('/respuesta_oferta/store',formData)
                    .then((response =>{

                        /* console.log(response) */

                        let foto = '';

                        if(response.data.foto == null)
                            foto = "/storage/img/usuario.jpg"
                        else
                            foto = "/storage/perfiles/imagenes/" + response.data.foto


                        if(response.data.imagen){

                            $('div[oferta_principal='+ response.data.oferta_id +']').append(
                                "<div nueva-respuesta-id='" + response.data.respuesta_oferta_id +
                                    "' class='temporal oferta-descripcion w-75 float-left nueva-respuesta'>"+

                                    "<div> "+

                                        "<img src='" + foto + "'</img>"+

                                    "</div>"+

                                        "<p class='m-0'>" + response.data.user + "</p>"+
                                        "<p class='parrafo'>" + response.data.contenido  + "</p>" +
                                        "<a class='mt-2' href='/storage/ofertas/" + response.data.imagen + "' data-lightbox='" + response.data.imagen + "' data-title='Imagen descriptiva'>"+
                                            "<img src='/storage/" + response.data.imagen + "'</img>"+
                                        "</a>"+
                                        "<button class='btn btn-sm btn-eliminar-respuesta-oferta float-right' style='color: #aaaaaa;' id='"+ response.data.respuesta_oferta_id +"'><i class='fas fa-trash-alt'></i></button>"+
                                "</div>"
                            );

                        }
                        else{

                            $('div[oferta_principal='+ response.data.oferta_id +']').append(
                                "<div nueva-respuesta-id='" + response.data.respuesta_oferta_id +
                                    "' class='temporal oferta-descripcion w-75 float-left nueva-respuesta'>"+

                                    "<div> "+

                                        "<img src='" + foto + "'</img>"+

                                    "</div>"+

                                        "<p class='m-0'>" + response.data.user + "</p>"+
                                        "<p class='parrafo'>" + response.data.contenido  + "</p>" +
                                        "<button class='btn btn-sm btn-eliminar-respuesta-oferta float-right' style='color: #aaaaaa;' id='"+ response.data.respuesta_oferta_id +"'><i class='fas fa-trash-alt'></i></button>"+
                                "</div>"
                            );

                        }

                        var res = $('div[nueva-respuesta-id="' + response.data.respuesta_oferta_id + '"]')
                        res[0].scrollIntoView({behavior:'smooth'})

                        this.myModel = false;

                    })).catch(response => {

                        /* console.log(response) */

                        if(response.status === 422) {
                            alert()
                            let errors = response.responseJSON.errors;
                            Object.keys(errors).forEach(function (key) {
                                $("#" + key + "Input").addClass("is-invalid");
                                $("#" + key + "Error").children("strong").text(errors[key][0]);
                            });
                        }

                        this.$swal({

                            title:"Hubo un error al hacer la respuesta.",
                            icon:'error'

                        })

                    });
            }
        },
        filters: {
            strippedContent: function(string) {
                return string.replace(/<\/?[^>]+>/ig, " ");
            },
        }
    }

</script>

<style scoped>

    .labela{
        font-size: 0.7875rem;
        color: white;
    }

    .labela i{
        font-size: 1rem;
    }

    .labela:hover {
        cursor: pointer;
    }

    .btn-guardar{
        color: white;
    }

    .btn-guardar i{
        color: white;
    }

    .modal-mask{
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper{
        display: table-cell;
        vertical-align: middle;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .nombre-texto{
        font-size: 16px;
        font-weight: 400;
    }

    .contenido-texto{
        font-size: 16px;
    }

</style>
