<template>

<div class="w-100">

    <button class="btn-mensaje " @click="abrir">Enviar un mensaje a {{ this.nombre }}</button>

     <div v-if="myModel" class="w-100">

        <transition name="modal">

            <div class="modal-mask">

                <div class="modal-wrapper w-100">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h4 class="modal-title mx-auto">Enviar Mensaje a {{ this.nombre }}</h4>

                                <button type="button" class="close float-right" @click="myModel=false"><span aria-hidden="true">&times;</span></button>

                            </div>

                            <div class="modal-body">

                                <form @submit.prevent="enviarMensaje">

                                    <div class="form-group ml-1 w-100">

                                        <textarea class="form-control" rows="3"  v-model="contenido" required></textarea>

                                    </div>

                                    <div class="d-flex justify-content-between w-100">

                                        <button type="submit" class="btn btn-block btn-guardar">Enviar</button>

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
        name:"EnviarMensaje",
        props:['nombre','id', 'tarea_id'],
        data(){
            return{
                myModel:false,
                contenido:null
            }
        },
        methods:{
            abrir(){
                this.myModel = true
            },
            enviarMensaje(){

                const formData = new FormData();

                formData.append('tarea_id', this.tarea_id);
                formData.append('autor_id', this.id);
                formData.append('contenido', this.contenido);

                axios.post('/api/enviar_mensaje/', formData)
                    .then(response => {

                        this.contenido = null;
                        this.myModel = false;

                        this.$swal({
                            position: 'center',
                            icon: 'success',
                            title: 'Tu mensaje se envio correctamente',
                            showConfirmButton: true,
                            confirmButtonText: 'Ir a la conversación',
                            showCloseButton: true

                        }).then((result) => {
                            window.location.href = "mensajes?tarea_id=" + this.tarea_id;
                        })

                        console.log(response);
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

    .btn-mensaje{
        color: rgb(0, 143, 180);
        background-color: rgb(246, 248, 253);
        border-radius: 160px;
        padding: 4px 14px;
        border-color: rgb(231, 235, 251);
        display: inline-block;
        text-align: center;
        font-size: 12px;
        border: 1px solid  rgb(0, 143, 180);
    }

    .btn-mensaje:hover{
        text-decoration: none;
        color: rgb(0, 143, 180);
    }

</style>
