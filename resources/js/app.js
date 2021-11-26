/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Vue from 'vue';

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(VueSweetalert2);

Vue.config.ignoredElements=['trix-editor', 'trix-toolbar'];

/* Fechas */
Vue.component('mostrar-fecha', require('./components/MostrarFecha.vue').default);

/* Eliminar Tarea */
Vue.component('eliminar-tarea', require('./components/EliminarTarea.vue').default);

/* Principal Tareas */
Vue.component('principal-tareas', require('./components/PrincipalTareas.vue').default);

/* Principal Tarea */
Vue.component('principal-tarea', require('./components/PrincipalTarea.vue').default);

/* Principal Mapa */
Vue.component('principal-mapa', require('./components/PrincipalMapa.vue').default);

/* Mostrar Tarea */
Vue.component('mostrar-tarea', require('./components/MostrarTarea.vue').default);

/* Hacer Oferta */
Vue.component('hacer-oferta', require('./components/HacerOferta.vue').default);

/* Respuesta Oferta */
Vue.component('respuesta-oferta', require('./components/RespuestaOferta.vue').default);

/* Eliminar Oferta */
Vue.component('eliminar-oferta', require('./components/EliminarOferta.vue').default);

/* Eliminar Respuesta Oferta */
Vue.component('eliminar-respuesta-oferta', require('./components/EliminarRespuestaOferta.vue').default);

/* Hacer Pregunta */
Vue.component('hacer-pregunta', require('./components/HacerPregunta.vue').default);

/* Respuesta Pregunta */
Vue.component('respuesta-pregunta', require('./components/RespuestaPregunta.vue').default);

/* Eliminar Pregunta */
Vue.component('eliminar-pregunta', require('./components/EliminarPregunta.vue').default);

/* Eliminar Respuesta Pregunta */
Vue.component('eliminar-respuesta-pregunta', require('./components/EliminarRespuestaPregunta.vue').default);

/* Notificacion */
Vue.component('notificacion-sweet', require('./components/NotificacionSweet.vue').default);

/* Filtro Tareas */
Vue.component('filtro-tareas', require('./components/FiltroTareas.vue').default);

/* Enviar Mensaje */
Vue.component('enviar-mensaje', require('./components/EnviarMensaje.vue').default);

/* Concluir Tarea */
Vue.component('concluir-tarea', require('./components/ConcluirTarea.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

require('./modalPublicar');

require('./mapa');

require('./dropzone');


