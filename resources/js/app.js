require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

import store from './store';

Vue.use(VueRouter)
Vue.use(Vuetify)


window.Vue = require('vue');

Vue.component('app', require('./components/AppComponent.vue').default);

Vue.component('app-footer', require('./components/Footer.vue').default);

Vue.component('app-bar', require('./components/AppBar.vue').default);

Vue.component('app-cart', require('./components/Cart.vue').default);

Vue.component('list-checkout', require('./components/ListToCheckOut.vue').default);



import router from './routes'

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
    store,
});
