<template>
    <div class="outfit-form">
        <h2 class="title">コーディネートを投稿する</h2>
        <form class="form" @submit.prevent="submit">
            <div class="form-group">
                <label>コーディネート写真</label>
                <input
                    class="form-control"
                    type="file"
                    name="outfit"
                    @change="onFileChange"
                />
                <output class="form-output" v-if="preview">
                    <img
                        class="img-fluid img-thumbnail"
                        :src="preview"
                        alt=""
                    />
                </output>
            </div>
            <div class="form-group">
                <label>何か書く(コーディネートのポイントなど)</label>
                <textarea
                    class="form-control"
                    maxlength="200"
                    name="description"
                    v-model="description"
                ></textarea>
            </div>
            <div class="form-group">
                <v-app>
                    <v-row>
                        <v-col>
                            <v-dialog
                                ref="dialog"
                                v-model="modal"
                                :return-value.sync="outfit_date"
                                width="290px"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field
                                        v-model="outfit_date"
                                        label="日付を選択する"
                                        prepend-icon="mdi-calendar"
                                        readonly
                                        v-bind="attrs"
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-date-picker
                                    locale="ja-jp"
                                    v-model="outfit_date"
                                    scrollable
                                    color="blue-grey darken-4"
                                >
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        text
                                        color="blue-grey darken-4"
                                        @click="modal = false"
                                    >
                                        キャンセル
                                    </v-btn>
                                    <v-btn
                                        text
                                        color="blue-grey darken-4"
                                        @click="$refs.dialog.save(outfit_date)"
                                    >
                                        OK
                                    </v-btn>
                                </v-date-picker>
                            </v-dialog>
                        </v-col>
                    </v-row>
                </v-app>
            </div>
            <div class="form-group">
                <button class="btn btn-dark text-light" type="submit">
                    投稿する
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: Boolean,
            required: true,
        },
    },
    data() {
        return {
            outfit_date: new Date(
                Date.now() - new Date().getTimezoneOffset() * 60000
            )
                .toISOString()
                .substr(0, 10),
            modal: false,
            outfit: null,
            description: null,
            preview: null,
        };
    },
    methods: {
        submit: function () {
            const formData = new FormData();
            formData.append('outfit', this.outfit);
            formData.append('description', this.description);
            formData.append('outfit_date', this.outfit_date);

            axios
                .post('/api/outfits', formData)
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error.response);
                });
        },
        onFileChange(event) {
            if (event.target.files.length === 0) {
                this.reset();
                return false;
            }

            if (!event.target.files[0].type.match('image.*')) {
                this.reset();
                return false;
            }

            const reader = new FileReader();

            reader.onload = (e) => {
                this.preview = e.target.result;
            };

            reader.readAsDataURL(event.target.files[0]);
            this.outfit = event.target.files[0];
        },
        reset() {
            this.preview = '';
            this.outfit = null;
            this.$el.querySelector('input[type="file"]').value = null;
        },
    },
};
</script>

<style>
.v-application--wrap {
    min-height: 0vh !important;
}
</style>