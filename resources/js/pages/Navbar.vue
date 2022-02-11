<template>
    <div>
        <nav
            class="navbar navbar-expand-lg fixed-top navbar-light p-0 bg-white"
        >
            <div class="container">
                <router-link :to="{ name: 'home' }" class="navbar-brand"
                    >DailyOutfits</router-link
                >
                <button
                    class="navbar-toggler"
                    data-toggle="collapse"
                    data-target="#navbarCollapse"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                data-toggle="collapse"
                                :to="{ name: 'home' }"
                            >
                                <i class="fas fa-home"></i>
                                Home
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                data-toggle="collapse"
                                :to="{ name: 'favorites' }"
                            >
                                <i class="fas fa-heart"></i>
                                Favorites
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                data-toggle="collapse"
                                :to="{ name: 'calender' }"
                            >
                                <i class="far fa-calendar"></i>
                                Calender
                            </router-link>
                        </li>
                    </ul>
                    <div>
                        <ul class="navbar-nav">
                            <li class="nav-item m-auto">
                                <button
                                    class="btn btn-outline-dark"
                                    data-toggle="modal"
                                    data-target="#exampleModalCenter"
                                    @click="showForm = !showForm"
                                >
                                    <i class="fas fa-plus"></i>
                                    コーディネートを投稿する
                                </button>
                            </li>
                            <li class="nav-item dropdown">
                                <a
                                    v-if="isLogin"
                                    class="nav-link dropdown-toggle text-center"
                                    href="#"
                                    id="navbarDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    {{ username }}
                                </a>
                                <router-link
                                    v-else
                                    class="nav-link text-center"
                                    data-toggle="collapse"
                                    :to="{ name: 'login' }"
                                    >ログイン / 新規登録
                                </router-link>
                                <div
                                    class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="navbarDropdown"
                                >
                                    <router-link
                                        class="dropdown-item text-center"
                                        :to="{ name: 'follows' }"
                                        >フォロー&フォロワー
                                    </router-link>
                                    <div class="dropdown-divider"></div>
                                    <div>
                                        <a
                                            v-if="isLogin"
                                            class="dropdown-item text-center"
                                            href="#"
                                            @click.prevent="logout"
                                        >
                                            ログアウト
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div
            class="modal fade"
            id="exampleModalCenter"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <Create v-model="showForm" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Create from './outfit/Create.vue';

export default {
    components: {
        Create,
    },
    computed: {
        isLogin() {
            return this.$store.getters['auth/check'];
        },
        username() {
            return this.$store.getters['auth/username'];
        },
    },
    data() {
        return {
            showForm: false,
        };
    },
    methods: {
        async logout() {
            await this.$store.dispatch('auth/logout').then(() => {
                this.$router.push('/login');
            });
        },
    },
};
</script>