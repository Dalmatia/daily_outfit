import './bootstrap';
require('./bootstrap');

window.Vue = require('vue').default;

import router from './router';
import store from './store';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import App from './layouts/App.vue';
import Vue from 'vue';

Vue.component('App', require('./layouts/App.vue').default);

Vue.use(Vuetify);

const createApp = async () => {
    await store.dispatch('auth/currentUser');
    new Vue({
        el: '#app',
        router,
        store,
        vuetify: new Vuetify(),
        render: (h) => h(App),
    });
};

createApp();
