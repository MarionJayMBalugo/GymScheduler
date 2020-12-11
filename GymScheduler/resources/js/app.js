/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('dashboard-component', require('./App.vue').default);
import 'vuetify/dist/vuetify.min.css'; 
import Vuetify from 'vuetify';
import VueRouter from 'vue-router';
import AddSchedule from  './components/Schedules/AddSchedule.vue';
import ViewSchedule from  './components/Schedules/ViewSchedule.vue';
import axios from 'axios';
import store from '../js/store'
Vue.prototype.$axios = axios
Vue.use(VueRouter)
Vue.use(Vuetify);

const routes = [
    { path: '/schedule/add', name:'add', component: AddSchedule},
    { path: '*', redirect: '/schedule/view'},
    { path: '/schedule/view', name:'view', component: ViewSchedule},
    { path: '/logout', name:'logout', component: ViewSchedule},
    { path: '/schedule/edit/:id', name:'edit', component: AddSchedule, props: true},
  ]

const router = new VueRouter({
    routes 
  })
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify : new Vuetify(),
    router,
    store
});
