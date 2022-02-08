<template>
    <footer class="footer fixed-bottom text-center">
        <button
            v-if="isLogin"
            class="btn btn-link text-secondary text-decoration-none"
            @click.prevent="logout"
        >
            ログアウト
        </button>
        <router-link
            v-else
            class="btn btn-link text-secondary text-decoration-none"
            data-toggle="collapse"
            :to="{ name: 'login' }"
            >ログイン / 新規登録
        </router-link>
    </footer>
</template>

<script>
export default {
    computed: {
        isLogin() {
            return this.$store.getters['auth/check'];
        },
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