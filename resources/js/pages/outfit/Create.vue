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