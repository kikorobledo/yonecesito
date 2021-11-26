<template>

    <div class="">

        <div v-if="myModel" class="w-100">

            <transition name="modal">

                <div class="modal-mask">

                    <div class="modal-wrapper w-100">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h4 class="modal-title mx-auto">Califica tu experiencia con el trabajdor</h4>

                                    <button type="button" class="close float-right" @click="myModel=false"><span aria-hidden="true">&times;</span></button>

                                </div>

                                <div class="modal-body">

                                    <form @submit.prevent="concluirTarea">

                                        <div class="form-group ml-1 d-flex">

                                            <div class="input-group w-25">

                                                <div class="input-group-prepend">

                                                    <button class="btn btn-success color-btn-guardar" type="button"><i class="fas fa-star"></i></button>

                                                </div>

                                                <input type="number" min="0" max="5" class="form-control" placeholder="0-5" aria-label="" aria-describedby="basic-addon1" v-model="rate">

                                            </div>

                                        </div>

                                        <div class="form-group ml-1 w-100">

                                            <textarea class="form-control" rows="3"  v-model="contenido" required placeholder="Cuentanos que te parecio el desempeño del trabajador"></textarea>

                                        </div>

                                        <div class="d-flex justify-content-between w-100">

                                            <button type="submit" class="btn btn-block btn-guardar">Concluir Tarea</button>

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
        props:['fechaVencimiento','tareaId','usuarioId', 'trabajadorId', 'trabajadorNombre'],
        data(){
            return{
                myModel:false,
                contenido:null,
                rate:null
            }
        },
        created(){
            let hoy = new Date();

            if(hoy.toISOString().split('T')[0] > this.fechaVencimiento){

                this.$swal.fire({
                    title: 'Ha pasado la fecha de vencimiento de tu tarea.',
                    text: '¿Deseas concluirla?.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.myModel = true;
                        }
                        })
            }

        },
        methods: {
            concluirTarea(){
                const formData = new FormData();

                formData.append('tarea_id', this.tareaId);
                formData.append('calificado', this.trabajadorId);
                formData.append('calificador', this.usuarioId);
                formData.append('contenido', this.contenido);
                formData.append('rate', this.rate);

                axios.post('/api/concluir_tarea/', formData)
                    .then(response => {
                        console.log(response);
                        this.myModel = false;
                        this.contenido = null;
                        this.rate = false;

                        this.$swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Tu reseña se guardo con exito.',
                            showConfirmButton: false,
                            timer: 9000
                            })

                        location.reload();

                    }).catch(error => {

                        this.contenido = null;
                        console.log(error);
                    })
            }
        }

    }

</script>

<style>

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

    .color-btn-guardar{
        background-color: #7db343;
    }

</style>
