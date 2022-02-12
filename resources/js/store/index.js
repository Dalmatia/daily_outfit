import Vue from 'vue';
import Vuex from 'vuex';

import auth from './auth';
import follow from './follow';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        auth,
        follow,
    },
});

export default store;
