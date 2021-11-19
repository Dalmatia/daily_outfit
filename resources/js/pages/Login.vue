<template>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">ログイン</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="email">メールアドレス :</label>
                        <input
                            type="text"
                            class="form-control"
                            name="email"
                            v-model="formData.email"
                        />
                        <p class="text-danger" v-text="errors.email"></p>
                    </div>
                    <div class="form-group">
                        <label for="password">パスワード :</label>
                        <input
                            type="password"
                            class="form-control"
                            name="password"
                            v-model="formData.password"
                        />
                        <p class="text-danger" v-text="errors.password"></p>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="p-2">
                        <div class="form-group text-center">
                            <button @click.prevent="login" class="btn btn-dark">
                                ログイン
                            </button>
                        </div>
                    </div>
                    <div class="p-2 text-center">
                        <router-link to="/register">
                            <button class="btn btn-dark">新規登録</button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                email: '',
                password: '',
            },
            errors: {},
        };
    },
    methods: {
        login() {
            axios
                .post('api/login', this.formData)
                .then(() => {
                    this.$router.push('/');
                })
                .catch((errors) => {
                    this.errors = errors.response.data.errors;
                });
        },
    },
};
</script>