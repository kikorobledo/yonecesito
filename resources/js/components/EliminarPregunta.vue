<template>

    <button class="btn btn-sm " v-on:click="eliminarPregunta"><i class="fas fa-trash-alt"></i></button>

</template>

<script>

    import{mapState} from 'vuex';
    import store from '../store';

    export default {
        props:['PreguntaId'],
        computed:{
           ...mapState(['preguntas', 'cantidadPreguntas'])
        },
        methods: {

            eliminarPregunta(){

                this.$swal.fire({
                    title: '¿Deseas eliminar esta pregunta?',
                    text: "Una vez eliminada no se podra recuperar.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                    }).then((result) => {

                        if (result.isConfirmed){

                            /* Eliminar la oferta con Axios */
                            const params = {
                                id: this.PreguntaId
                            };


                            axios.post(`/api/pregunta/${this.PreguntaId}`, {params, _method:'delete'})
                                .then(respuesta => {

                                    if(this.cantidadPreguntas === 1)
                                        this.$store.commit("CARGAR_CANTIDAD_PREGUNTAS", 0)

                                    this.$swal({

                                            title:"Pregunta eliminada",
                                            icon:'success'

                                        }).then((result) => {

                                            $('div[pregunta_principal='+ this.PreguntaId +']').remove();

                                            for (let index = 0; index < this.preguntas.length; index++) {
                                                if(this.preguntas[index].id == this.PreguntaId)
                                                    this.preguntas.splice(index,1);
                                            }

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
