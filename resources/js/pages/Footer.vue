<template>
    <footer class="footer fixed-bottom text-center">
        <button
            class="btn btn-link text-secondary text-decoration-none"
            @click.prevent="logout"
        >
            ログアウト
        </button>
        <router-link
            class="btn btn-link text-secondary text-decoration-none"
            data-toggle="collapse"
            :to="{ name: 'login' }"
            >ログイン / 新規登録
        </router-link>
    </footer>
</template>

<script>
export default {
    methods: {
        logout() {
            axios.post('api/logout').then(() => {
                this.$router.push('/login');
            });
        },
    },
};
</script>