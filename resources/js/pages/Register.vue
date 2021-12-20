<template>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">新規登録</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">アカウント名 :</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            v-model="formData.name"
                        />
                        <p class="text-danger" v-text="errors.name"></p>
                    </div>
                    <div class="form-group">
                        <label for="email">メールアドレス :</label>
                        <input
                            type="text"
                            class="form-control"
                            id="email"
                            v-model="formData.email"
                        />
                        <p class="text-danger" v-text="errors.email"></p>
                    </div>
                    <div class="form-group">
                        <label for="password">パスワード :</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            v-model="formData.password"
                        />
                        <p class="text-danger" v-text="errors.password"></p>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation"
                            >パスワード(再確認) :</label
                        >
                        <input
                            type="password"
                            class="form-control"
                            id="password_confirmation"
                            v-model="formData.password_confirmation"
                        />
                        <p
                            class="text-danger"
                            v-text="errors.password_confirmation"
                        ></p>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="p-2">
                        <div class="form-group text-center">
                            <button @click="registerUser" class="btn btn-dark">
                                登録
                            </button>
                        </div>
                    </div>
                    <div class="p-2 text-center">
                        <router-link to="/login"
                            >既にアカウントをお持ちの方</router-link
                        >
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
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            errors: {},
        };
    },
    methods: {
        registerUser() {
            axios
                .post('api/register', this.formData)
                .then((response) => {
                    console.log(response.data);
                    this.formData.name =
                        this.formData.email =
                        this.formData.password =
                        this.formData.password_confirmation =
                            '';
                    this.errors = {};
                    this.$router.push('/');
                    this.$register.success('アカウント登録が完了しました!');
                })
                .catch((errors) => {
                    this.errors = errors.response.data.errors;
                    console.log(errors.response.data.errors);
                });
        },
    },
};
</script>