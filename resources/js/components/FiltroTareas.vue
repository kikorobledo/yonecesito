<template>

    <div class="">

        <form @submit.prevent="filtrar()" class="d-flex justify-content-between mt-3">

            <button type="button"  class="btn btn-filtro dropdown-toggle" data-toggle="dropdown" aria-expanded="false" @click="abrir($event)">Filtrar</button>

            <div class="dropdown-menu dropdown-ubicacion">

                <p>Tipo De Actividad</p>

                <div class="form-group">

                    <div class="btn-group btn-group-toggle" data-toggle="buttons">

                        <label class="btn btn-secondary radio" @change="estadoActiva($event)">

                            <input type="radio" id="radio1" autocomplete="off" value="presencial" v-model="tipo"> Presencial

                        </label>

                        <label class="btn btn-secondary radio" @change="estadoActiva($event)">

                            <input type="radio" id="radio2" autocomplete="off" value="remoto" v-model="tipo"> Remoto

                        </label>

                        <label class="btn btn-secondary radio" @change="estadoActiva($event)">

                            <input type="radio" id="radio3" autocomplete="off" value="todas" v-model="tipo"> Todas

                        </label>

                    </div>

                </div>

                <div class="dropdown-divider"></div>

                <p>Estado</p>

                <div class="form-group text-left">

                    <select class="form-control" v-model="estado">

                        <option v-for="estado in estados" v-bind:key="estado.id" :value="estado.id">
                            {{ estado.nombre }}
                        </option>

                    </select>

                </div>

                <div class="dropdown-divider"></div>

                <p>Presupuesto</p>

                <div class="form-group text-center">

                    <span class="font-weight-bold text-primary ml-2 valueSpan2"></span>

                    <div class="d-flex justify-content-center my-4">


                        <div class="w-100">

                            <input type="range" id="customRange11" class="custom-range" min="0" max="100000" value="0">

                        </div>

                    </div>

                </div>


                <div class="dropdown-divider"></div>

                <button type="submit" class="btn btn-siguiente btn-block">Aplicar</button>

            </div>

            <input type="text" class="form-control buscador" id="buscar" placeholder="Buscar tarea" v-model="search">

        </form>

    </div>

</template>

<script>

    import{mapState, mapActions} from 'vuex'
    import store from '../store'

    export default {
        store,
        name:'FiltroTareas',
        props:['estados'],
        data () {
            return{
                estado:null,
                tipo:null,
                presupuesto:0,
                search:null
            }
        },
        computed:{
            ...mapState(['tareas']),
        },
        methods: {
            ...mapActions(['filtrarTareas']),
            filtrar(){

                const formData = new FormData();

                formData.append('search', this.search);
                formData.append('tipo', this.tipo);
                formData.append('presupuesto', this.presupuesto);
                formData.append('estado', this.estado);

                try {

                    axios.post('/api/tareas_filtradas/', formData)
                    .then(respuesta =>{
                        /* console.log(respuesta); */

                        if(respuesta.data.length == 0){
                            this.$swal({

                                title:"No hay concidencias para la busqueda.",
                                icon:'warning'

                            })
                        }else{
                            this.$store.commit("CARGAR_TAREAS", respuesta.data)
                        }
                    })
                } catch (error) {
                    console.log(error);
                }

                this.estado = null
                this.tipo = null
                this.presupuesto = null
                this.search = null

                $('.dropdown-ubicacion').hide()

            },
            abrir(e){
                $('.dropdown-ubicacion').show()
                $('.dropdown-ubicacion').click(function (e) {
                    e.stopPropagation()
                });
            },
            estadoActiva(e){

                const radio = $('.radio');

                for (let index = 0; index < radio.length; index++) {
                    radio[index].classList.remove('active');

                }

                e.currentTarget.classList.add('active')
            }
        },
        mounted() {

            const $valueSpan = $('.valueSpan2');

            const $value = $('#customRange11');
            $valueSpan.html($value.val());
            $value.on('input change', () => {

                $valueSpan.html("$" + $value.val());

                this.presupuesto = $value.val();
            });
        }
    }

</script>

<style scoped >

    .dropdown-ubicacion{
        padding:30px;
    }

    .btn-siguiente{
        color: rgb(0, 143, 180);
        background-color: rgb(246, 248, 253);
        border-radius: 160px;
        padding: 8px 16px;
        border-color: rgb(231, 235, 251);
        display: inline-block;
        text-align: center;
        font-weight: 600;
    }

</style>
