import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home.vue';
import Favorites from './pages/Favorites.vue';
import Register from './pages/Register.vue';
import Login from './pages/Login.vue';
import OutfitDetail from './pages/OutfitDetail.vue';

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
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/outfits/:id',
            component: OutfitDetail,
            name: 'outfitDetail',
            props: true,
        },
    ],
});

export default router;
