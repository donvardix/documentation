/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.initMap = function () {
    var myLatLng = {lat: 34.101279, lng: -118.343655};

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 20,
        center: myLatLng
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map
    });
};

//window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*const app = new Vue({
    el: '#app',
});*/

import Vue from 'vue'

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify);

import VueRouter from 'vue-router'
Vue.use(VueRouter);
import App from './components/App'
import Register from './components/Register'
import AllMembers from './components/AllMembers'
import Login from './components/Login'

import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

import Vuex from 'vuex'
Vue.use(Vuex);
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: 'history',
    routes:[
        {
            path: '/',
            name: 'register',
            component: Register
        },
        {
            path: '/all-members',
            name: 'all-members',
            component: AllMembers
        },
        {
            path: '/admin',
            name: 'admin',
            component: Login
        },
    ],
});

Vue.router = router;

const store = new Vuex.Store({
    state: {
        formstep: 1,
        countMembers: 0,
        adminToken: ''
    },
    mutations: {
        nextStepMut(state) {
            state.formstep++;
        },
        setCountMembers (state, payload) {
            state.countMembers = payload;
        },
        setStep(state, payload) {
            state.formstep = payload;
        },
    },
    actions: {
        countMembers({commit}) {
            axios
                .get('api/count')
                .then(response => response.data.count)
                .then(counts => {
                    commit('setCountMembers', counts)
                })
        },
        nextStep({commit}) {
            commit('nextStepMut')
        },
        hideMember({commit, state}, memberid) {
            axios.get('hide/' + memberid)
        },
        showMember({commit, state}, memberid) {
            axios.get('show/' + memberid)
        },
        secondForm({commit, state}, formData){
            axios
                .post('/store2', formData, {'Content-Type': 'multipart/form-data' })
                .then(respond => {
                    commit('nextStepMut')
            })
        },
        login({commit, state}, formData){
            axios.post('/login-admin', formData).then(respond => {
                state.adminToken = respond.data.token
                router.push('all-members')
            })
        }
    },
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    store,
    router,
});