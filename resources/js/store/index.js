import { isInteger } from 'lodash';
import Vue from  'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({

    state: {
        tareas:[],
        tareasFiltradas:[],
        tarea:{},
        mapa:true,
        ofertas:{},
        cantidadOfertas: Number,
        cantidadPreguntas: Number,
        preguntas:{},
        user_id: Number,
        estados:{},
        usuarioLogeado:{}
    },
    mutations: {
        CARGAR_TAREAS(state, tareas){
            state.tareas = tareas;
        },
        CARGAR_TAREAS_FILTRADAS(state, tareasFiltradas){
            state.tareasFiltradas = tareasFiltradas;
        },
        CARGAR_TAREA(state, tarea){
            state.tarea = tarea;
        },
        CAMBIAR_MAPA(state, mapa){
            state.mapa = mapa;
        },
        CARGAR_OFERTAS(state, ofertas){
            state.ofertas = ofertas;
        },
        CARGAR_CANTIDAD_OFERTAS(state, cantidadOfertas){
            state.cantidadOfertas = cantidadOfertas;
        },
        CARGAR_PREGUNTAS(state, preguntas){
            state.preguntas = preguntas;
        },
        CARGAR_CANTIDAD_PREGUNTAS(state, cantidadPreguntas){
            state.cantidadPreguntas = cantidadPreguntas;
        },
        CARGAR_USER_ID(state, user_id){
            state.user_id = user_id;
        },
        CARGAR_USUSARIOLOGEADO(state, usuarioLogeado){
            state.usuarioLogeado = usuarioLogeado;
        },
        CARGAR_ESTADOS(state, estados){
            state.estados = estados;
        },
    },
    actions:{
        ofertas({commit, state}, id){
            try {

                axios.get('/api/ofertas/' + id)
                .then(respuesta =>{
                    /* console.log(respuesta); */
                    commit("CARGAR_OFERTAS", respuesta.data);
                    commit("CARGAR_CANTIDAD_OFERTAS", respuesta.data.length)
                })
            } catch (error) {
                console.log(error);
            }
        },
        preguntas({commit, state}, id){
            try {

                axios.get('/api/preguntas/' + id)
                .then(respuesta =>{
                    /* console.log(respuesta); */
                    commit("CARGAR_PREGUNTAS", respuesta.data);
                    commit("CARGAR_CANTIDAD_PREGUNTAS", respuesta.data.length)
                })
            } catch (error) {
                console.log(error);
            }
        },
        usuario({commit, state}, id){
            try {

                axios.get('/api/usuario/' + id)
                .then(respuesta =>{
                    /* console.log(respuesta); */
                    commit("CARGAR_USUSARIOLOGEADO", respuesta.data[0]);
                })
            } catch (error) {
                console.log(error);
            }

        },
        filtrarTareas({commit, state},filtro){

            commit("CARGAR_TAREAS", state.tareas)

            /* for(var key in filtro){
                console.log(key)
            } */

            let search = state.tareas.filter((tarea)=> {
                if(
                    tarea.nombre.match(filtro.search) ||
                    tarea.direccion.match(filtro.search) ||
                    tarea.colonia.match(filtro.search) ||
                    tarea.descripcion.match(filtro.search) && filtro.search != null
                )
                    return true;
                else
                    return false;
            })

            console.log("Search: ", search)


            let tipo = state.tareas.filter((tarea)=> {
                if(
                    tarea.tipo === filtro.tipo && filtro.tipo != null
                )
                    return true;
                else
                    return false;
            })

            console.log("Tipo: ",tipo)

            let estado = state.tareas.filter((tarea)=> {
                if(
                    tarea.estado_id === filtro.estado && filtro.estado != null
                )
                    return true;
                else
                    return false;
            })

            console.log("Estado: ",estado)

            let presupuesto = state.tareas.filter((tarea)=> {
                if(
                    tarea.presupuesto >= filtro.presupuesto && filtro.presupuesto != null
                )
                    return true;
                else
                    return false;
            })

            console.log("Presupuesto: ",presupuesto)


        }
    }

});
