<template>

    <button class="btn btn-block btn-danger btn-sm mt-2" v-on:click="eliminarTarea">Borrar Tarea</button>

</template>

<script>

    export default {
        props:['tareaId'],
        methods: {

            eliminarTarea(){

                this.$swal.fire({
                    title: '¿Deseas eliminar esta tarea?',
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
                                id: this.tareaId
                            };
                            axios.post(`/tarea/${this.tareaId}`, {params, _method:'delete'})
                                .then(respuesta => {
                                    console.log(respuesta)
                                    this.$swal({
                                            title:"Tarea eliminada",
                                            icon:'success'
                                        }).then((result) => {
                                            window.location.href = "mistareas";
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
