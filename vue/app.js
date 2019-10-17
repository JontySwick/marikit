import Vue from 'vue';

import App from './components/App.vue';
import ProductsList from './components/ProductsList.vue';
import BasketList from './components/BasketList.vue';

import axios from 'axios';

Vue.component('ProductsList', ProductsList);
Vue.component('BasketList', BasketList);

new Vue({
    el: '#app',
    render: h => h(App)
})