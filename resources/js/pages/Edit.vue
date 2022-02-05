<template>
    <div>
        <div
            class="modal fade"
            id="editModal"
            tabindex="-1"
            aria-labelledby="editModal"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">編集画面</h5>
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
                        <form
                            enctype="multipart/form-data"
                            @submit.prevent="updateOutfit"
                        >
                            <div class="form-group">
                                <label>コーディネート写真</label>
                                <input
                                    type="file"
                                    name="outfit"
                                    class="form-control"
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
                                <label>内容</label>
                                <textarea
                                    class="form-control"
                                    maxlength="200"
                                    name="description"
                                    required=""
                                    v-model="outfit.description"
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <v-app>
                                    <v-row>
                                        <v-col>
                                            <v-dialog
                                                ref="dialog"
                                                v-model="editModal"
                                                :return-value.sync="
                                                    outfit.outfit_date
                                                "
                                                width="290px"
                                            >
                                                <template
                                                    v-slot:activator="{
                                                        on,
                                                        attrs,
                                                    }"
                                                >
                                                    <v-text-field
                                                        v-model="
                                                            outfit.outfit_date
                                                        "
                                                        label="日付を選択する"
                                                        prepend-icon="mdi-calendar"
                                                        readonly
                                                        v-bind="attrs"
                                                        v-on="on"
                                                    ></v-text-field>
                                                </template>
                                                <v-date-picker
                                                    locale="ja-jp"
                                                    v-model="outfit.outfit_date"
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
                                                        @click="
                                                            $refs.dialog.save(
                                                                outfit_date
                                                            )
                                                        "
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
                                <button
                                    class="btn btn-dark text-white"
                                    type="submit"
                                >
                                    投稿内容を更新する
                                </button>
                            </div>
                        </form>
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
            outfit: '',
            description: null,
            outfit_date: new Date(
                Date.now() - new Date().getTimezoneOffset() * 60000
            )
                .toISOString()
                .substr(0, 10),
            editModal: false,
            preview: null,
        };
    },
    created() {
        this.fetchOutfit();
    },
    methods: {
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
        },
        async fetchOutfit() {
            const id = this.$route.params.id;
            const response = await axios.get(`/api/outfits/${id}`);
            console.log(response);
            this.outfit = response.data;
            this.preview = this.outfit.url;
        },
        updateOutfit() {
            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                },
            };
            let formData = new FormData();
            formData.append('outfit', this.outfit);
            formData.append('description', this.description);
            formData.append('outfit_date', this.outfit_date);
            formData.append('_method', 'put');
            axios
                .post(
                    '/api/outfits/' + this.$route.params.id + '/edit',
                    formData,
                    config
                )
                .then((response) => {
                    $('#editModal').modal('hide');
                    this.$emit('recordUpdated', response);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>