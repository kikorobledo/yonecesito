<template>

    <button class="btn btn-sm " v-on:click="eliminarRespuesta"><i class="fas fa-trash-alt"></i></button>

</template>

<script>

    export default {
        props:['respuestaOfertaId'],
        methods: {

            eliminarRespuesta(){

                this.$swal.fire({
                    title: '¿Deseas eliminar esta respuesta?',
                    text: "Una vez eliminada no se podra recuperar.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                    }).then((result) => {

                        if (result.isConfirmed){

                            /* Eliminar la tarea con Axios */
                            const params = {
                                id: this.respuestaOfertaId
                            };


                            axios.post(`/respuesta_oferta/${this.respuestaOfertaId}`, {params, _method:'delete'})
                                .then(respuesta => {

                                    this.$swal({

                                            title:"Respuesta eliminada",
                                            icon:'success'

                                        }).then((result) => {

                                            $('div[respuesta_oferta_id='+ this.respuestaOfertaId +']').remove();

                                        })
                                }).catch(error => {

                                    console.log(error);

                                });
                        }
                    })
            }
        }
    }

</script>
