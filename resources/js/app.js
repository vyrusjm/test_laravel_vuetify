require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';

import store from './store';

Vue.use(Vuetify)

window.Vue = require('vue');

Vue.component('app', require('./components/AppComponent.vue').default);


import router from './routes'


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);



const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
    store
});
