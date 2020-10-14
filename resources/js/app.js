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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/* Fechas */
Vue.component('mostrar-fecha', require('./components/MostrarFecha.vue').default);

/* Eliminar Tarea */
Vue.component('eliminar-tarea', require('./components/EliminarTarea.vue').default);

/* Respuesta Oferta */
Vue.component('respuesta-oferta', require('./components/RespuestaOferta.vue').default);

/* Eliminar Respuesta Oferta */
Vue.component('eliminar-respuesta-oferta', require('./components/EliminarRespuestaOferta.vue').default);

/* Notificacion */
Vue.component('notificacion-sweet', require('./components/NotificacionSweet.vue').default);

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


