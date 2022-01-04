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
                    </ul>
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
                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                data-toggle="collapse"
                                :to="{ name: 'login' }"
                                >ログイン / 新規登録
                            </router-link>
                        </li>
                    </ul>
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
    data() {
        return {
            showForm: false,
        };
    },
};
</script>