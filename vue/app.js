import Vue from 'vue';

import App from './components/App.vue';
import ProductsList from './components/ProductsList.vue';
import BasketList from './components/BasketList.vue';

Vue.component('ProductsList', ProductsList);
Vue.component('BasketList', BasketList);

import axios from 'axios';

axios.defaults.headers.common['Authorization'] = 'Bearer 100-token';

new Vue({
    el: '#app',
    render: h => h(App)
})