<template>

    <button class="btn btn-sm btn-oferta-respuesta" v-on:click="this.responder"><i class="fas fa-reply"></i>Responder</button>

</template>

<script>

    import EliminarRespuestaOferta from  './EliminarRespuestaOferta';

    export default {
        props:['respuestaId', 'autor', 'ofertaContenido', 'ofertaId', 'imagen'],
        components:{
            EliminarRespuestaOferta
        },
        mounted() {

            /* Cambiar aspecto del input file */
            var loader = function(e){

                let file = e.target.files;

                let show = "<span>" + file[0].name + "</span>";

                let output = document.querySelector('.labela');
                output.innerHTML = show;
                output.classList.add("active");
            }

            let fileInput = document.querySelector('#imagen-respuesta-oferta');
            fileInput.addEventListener('change', loader);

        },
        methods: {
            responder(){

                /* Resetear form al cerrar modal */
                $( "#modalRespuestaOferta" ).on('hidden.bs.modal', function(){

                    document.querySelector('#form_respuesta_oferta').reset();
                    let output = document.querySelector('.labela');
                    output.innerHTML = "<i class='far fa-images'></i>";
                });

                var imagen = this.imagen;
                var oferta_contenido = this.ofertaContenido;
                var oferta_id = this.ofertaId;
                var autor = this.autor

                $('#modalRespuestaOferta').on('show.bs.modal', function(){

                    $(this).find('#imagen-oferta-respuesta').attr("src", "/storage/perfiles/imagenes/" + imagen);
                    $(this).find('#perfil-oferta-respuesta').text(autor);
                    $(this).find('#oferta_id_respuesta').val(oferta_id);
                    $(this).find('#contenido-oferta-respuesta').text(oferta_contenido);

                });

                $('#modalRespuestaOferta').modal({

                    show: true

                })

                this.respuesta();
                event.stopPropagation()
            },
            respuesta(){
                /* Guardar la respuesta en la base de datos */
                $('#form_respuesta_oferta').submit(function(e){

                    e.preventDefault();

                    let formData = new FormData();

                    const oferta_id = $('#oferta_id_respuesta').val();

                    formData.append('contenido_respuesta_oferta', $('#contenido_respuesta_ofertaInput').val());

                    formData.append('oferta_id', $('#oferta_id_respuesta').val());

                    formData.append('user_id', $('#oferta_id_user').val());

                    if($('input[type=file]')[0].files[0]){
                        formData.append('imagen-respuesta-oferta', $('input[type=file]')[0].files[0]);
                    }

                    axios.post('http://127.0.0.1:8000/respuesta_oferta/store',formData)
                        .then((response =>{

                        console.log(response)

                        $("#modalRespuestaOferta" ).modal('hide');

                            if(response.data.imagen){

                                $('button[oferta-id-principal='+ response.data.oferta_id +']').parent().parent().parent().parent().append(
                                    "<div nueva-respuesta-id='" + response.data.respuesta_oferta_id +
                                        "' class='oferta-descripcion w-75 float-right nueva-respuesta'>"+

                                        "<div> "+

                                            "<img src='/storage/perfiles/imagenes/" + response.data.foto + "'</img>"+

                                        "</div>"+

                                                "<p>" + response.data.user + "</p>"+
                                                "<p class='parrafo'>" + response.data.contenido  + "</p>" +
                                                "<eliminar-tarea tarea-id='" + response.data.respuesta_oferta_id +"'></eliminar-tarea>"+
                                                "<a href='/storage/" + response.data.imagen + "' data-lightbox='" + response.data.imagen + "' data-title='Imagen descriptiva'>"+
                                                    "<img src='/storage/" + response.data.imagen + "'</img>"+
                                                "</a>"+
                                    "</div>"
                                );

                            }
                            else{

                                $('button[oferta-id-principal='+ response.data.oferta_id +']').parent().parent().parent().parent().append(
                                    "<div nueva-respuesta-id='" + response.data.respuesta_oferta_id +
                                        "' class='oferta-descripcion w-75 float-right nueva-respuesta'>"+

                                        "<div> "+

                                            "<img src='/storage/perfiles/imagenes/" + response.data.foto + "'</img>"+

                                        "</div>"+

                                                "<p>" + response.data.user + "</p>"+
                                                "<p class='parrafo'>" + response.data.contenido  + "</p>" +
                                                "<eliminar-tarea tarea-id='" + response.data.respuesta_oferta_id +"'></eliminar-tarea>"+
                                    "</div>"
                                );

                            }

                            const res = document.querySelector('.nueva-respuesta');
                            res.scrollIntoView();
                            res.scrollIntoView(true);
                            res.scrollIntoView(false);


                        })).catch(response => {

                            console.log(response)

                            if(response.status === 422) {
                                alert()
                                let errors = response.responseJSON.errors;
                                Object.keys(errors).forEach(function (key) {
                                    $("#" + key + "Input").addClass("is-invalid");
                                    $("#" + key + "Error").children("strong").text(errors[key][0]);
                                });
                            }

                        });
                });
            }
        }
    }

</script>
