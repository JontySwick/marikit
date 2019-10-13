//require('./bootstrap');
//window.Vue = require('vue');

import Vue from 'vue';
import VueRouter from 'vue-router';

import App from './components/App.vue';
import ProductsList from './components/ProductsList.vue';

Vue.component('ProductsList',ProductsList);

Vue.use(VueRouter);

const routes = [
    {
        path : '/',
        component : ProductsList
    },
    {
        path : '*',
        component : ProductsList
    }
];

const router = new VueRouter ({
    mode: 'history',
    routes
});

import axios from 'axios';
axios.defaults.headers.common['Authorization'] = 'Bearer 100-token';

new Vue({
    router,
    el: '#app',
    render: h => h(App)
})