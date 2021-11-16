<template>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">ログイン</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="email">メールアドレス :</label>
                        <input type="text" class="form-control" name="email" />
                    </div>
                    <div class="form-group">
                        <label for="password">パスワード :</label>
                        <input
                            type="password"
                            class="form-control"
                            name="password"
                        />
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="p-2">
                        <div class="form-group text-center">
                            <button class="btn btn-dark">ログイン</button>
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