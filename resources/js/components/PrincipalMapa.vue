<template>

    <div class="mapa">

        <l-map
            :zoom="zoom"
            :center="center"
            :options="mapOptions"
        >

            <l-tile-layer :url="url" :attribution="attribution" />

            <l-marker
                v-for="tarea in this.tareas" v-bind:key="tarea.id"
                :lat-lng="obtenerCoordenadas(tarea)"
                :icon="iconoEstablecimiento()"
                @click="cargarTarea(tarea)"
            >

                <l-tooltip>

                    <div>

                        {{ tarea.nombre }}

                    </div>

                </l-tooltip>

            </l-marker>

        </l-map>

    </div>

</template>

<script>

    import store from '../store'
    import { LMap, LTileLayer, LMarker, LTooltip, LIcon } from 'vue2-leaflet'
    import { latLng } from 'leaflet'
    import {mapActions} from 'vuex'

    export default {
        store,
        components: {
            LMap,
            LTileLayer,
            LMarker,
            LTooltip,
            LIcon
        },data(){
            return {
                zoom: 5,
                center: latLng(20.666332695977, -103.392177745699),
                url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                currentZoom: 11.5,
                currentCenter:latLng(20.666332695977, -103.392177745699),
                showParagraph:false,
                mapOptions:{
                    zoomSnap: 0.5
                },
                showMap:true,
            }
        },computed: {
            tareas(){
                return this.$store.state.tareas;
            }
        },
        methods: {
            ...mapActions(['ofertas', 'preguntas']),
            obtenerCoordenadas(tarea){
                return {
                    lat: tarea.lat,
                    lng: tarea.lng
                };
            },
            iconoEstablecimiento(){
                return L.icon({
                    iconUrl:'/storage/img/pin.png',
                    iconSize: [40,50    ]
                })
            },
            cargarTarea(tarea){
                this.$store.commit("CARGAR_TAREA", tarea);
                this.$store.commit("CAMBIAR_MAPA", false);
                this.ofertas(tarea.id);
                this.preguntas(tarea.id);
            }
        }
    }

</script>

<style scoped>

    @import 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css';

    .mapa{
        height: 100%;
        width: 100%;
    }

</style>
