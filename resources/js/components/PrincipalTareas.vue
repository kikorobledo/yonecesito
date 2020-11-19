<template>

  <div class="lista-tareas">

      <div
        v-for="tarea in this.tareas.slice().reverse()" v-bind:key="tarea.id"
        class="tarea border-activa"
        @click="cargarTarea(tarea,$event)"
      >
        <p class="tipo_tarea">{{ tarea.nombre }}</p>

        <div class="row tarea_conjunto">

            <div class="col-3 mr-0 pr-0">

                <img v-if="tarea.usuario.perfil.imagen != null" :src="`/storage/perfiles/imagenes/${tarea.usuario.perfil.imagen}`"  alt="Foto Perfil" class="foto-perfil-barra">

                <img v-else src="/storage/img/usuario.jpg"  alt="Foto Perfil" class="foto-perfil-barra">

            </div>

            <div class="col-6 mr-0 ml-0 pr-0 pl-0">

                <p class="descripcion">{{tarea.descripcion | strippedContent}}...</p>

            </div>

            <div class="col-3 mr-0 ml-0 pr-0 pl-0 ">

                <p class="precio">${{ tarea.presupuesto }}</p>

            </div>

        </div>

        <div class="direccion">

            <i class="fas fa-map-marker-alt"></i>

            <p>{{ tarea.estado.nombre }} / {{ tarea.direccion }}</p>

        </div>

        <div class="estrellas">

            <i class="fas fa-calendar-alt"></i>

            <mostrar-fecha :fecha=tarea.fecha_de_vencimiento></mostrar-fecha>

        </div>

      </div>

  </div>

</template>

<script>

    import store from '../store'
    import MostrarFecha from './MostrarFecha'
    import {mapActions} from 'vuex'

    export default {
        store,
        components: {
            MostrarFecha,
        },
        mounted(){
            axios.get('/api/tareas')
            .then(respuesta => {
                /* console.log(respuesta) */
                this.$store.commit("CARGAR_TAREAS", respuesta.data);
            });
        },
        computed:{
            tareas(){
                return this.$store.state.tareas;
            },
            tareasFiltradas(){
                return this.$store.state.tareasFiltradas;
            }
        },
        methods: {
            ...mapActions(['ofertas', 'preguntas']),
            tareaActiva(){
                const tareas = this.$el.querySelectorAll('.tarea')

                tareas.forEach(tarea => {
                    if(tarea.classList.contains('borde-activa-completo'))
                        tarea.classList.remove('borde-activa-completo')
                });
            },
            cargarTarea(tarea,e){

                document.querySelectorAll('.temporal').forEach(e => e.remove());

                $('.descripcion-tarea')[0].firstChild.scroll({top:0,behavior:'smooth'});

                this.tareaActiva()

                e.path.forEach(element => {
                    if(element.className === 'tarea border-activa')
                        element.classList.add('borde-activa-completo')
                });

                this.$store.commit("CARGAR_TAREA", tarea);
                this.$store.commit("CAMBIAR_MAPA", false);
                this.ofertas(tarea.id);
                this.preguntas(tarea.id);
            }
        },
        filters: {
            strippedContent: function(string) {
                return string.replace(/<\/?[^>]+>/ig, " ").substring(0,40);
            }
        }
    }

</script>

<style scoped>

    .lista-tareas{
        height: calc(100vh - 213px);
        overflow: scroll;
        overflow-x: hidden
    }

</style>
