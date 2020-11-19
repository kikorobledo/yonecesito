<template>

    <div  class="lista-tareas">

        <principal-mapa v-if="mapa"></principal-mapa>

        <mostrar-tarea v-if="!mapa"></mostrar-tarea>

    </div>

</template>

<script>

    import PrincipalMapa from './PrincipalMapa'
    import store from '../store'

    export default {
        store,
        props:['user_id', 'estados'],
        components: {
            PrincipalMapa
        },
        computed: {
            mapa(){
                return this.$store.state.mapa;
            }
        },
        mounted(){
            this.$store.commit("CARGAR_USER_ID", parseInt(this.user_id));
            this.$store.commit("CARGAR_ESTADOS", this.estados);
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
