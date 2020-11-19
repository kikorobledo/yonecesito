<template>

    <button class="btn btn-sm " v-on:click="eliminarOferta"><i class="fas fa-trash-alt"></i></button>

</template>

<script>

    import{mapState} from 'vuex'
    import store from '../store'

    export default {
        props:['ofertaId'],
        computed:{
            ...mapState(['ofertas', 'cantidadOfertas'])
        },
        methods: {

            eliminarOferta(){

                this.$swal.fire({
                    title: '¿Deseas eliminar esta oferta?',
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
                                id: this.ofertaId
                            };


                            axios.post(`/api/oferta/${this.ofertaId}`, {params, _method:'delete'})
                                .then(respuesta => {

                                    if(this.cantidadOfertas === 1)
                                        this.$store.commit("CARGAR_CANTIDAD_OFERTAS", 0)

                                    this.$swal({

                                            title:"Oferta eliminada",
                                            icon:'success'

                                        }).then((result) => {

                                            $('div[oferta_principal='+ this.ofertaId +']').remove();

                                            for (let index = 0; index < this.ofertas.length; index++) {
                                                if(this.ofertas[index].id == this.ofertaId)
                                                    this.ofertas.splice(index,1);
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
