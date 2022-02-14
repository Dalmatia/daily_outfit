import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home.vue';
import Favorites from './pages/Favorites.vue';
import Calender from './pages/Calender.vue';
import Register from './pages/Register.vue';
import Login from './pages/Login.vue';
import OutfitDetail from './pages/OutfitDetail.vue';
import Follows from './pages/Follows.vue';

import store from './store';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/favorites',
            name: 'favorites',
            component: Favorites,
        },
        {
            path: '/calender',
            name: 'calender',
            component: Calender,
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            beforeEnter(to, from, next) {
                if (store.getters['auth/check']) {
                    next('/');
                } else {
                    next();
                }
            },
        },
        {
            path: '/outfits/:id',
            component: OutfitDetail,
            name: 'outfitDetail',
            props: true,
        },
        {
            path: '/follows',
            name: 'follows',
            component: Follows,
        },
    ],
});

export default router;
