<template>
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
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
                            Home
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'about' }"
                        >
                            About
                        </router-link>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item m-auto">
                        <button class="btn btn-light">
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
</template>