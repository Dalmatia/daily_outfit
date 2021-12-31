<template>
    <div>
        <h2>Outfit Detail</h2>
        <div
            class="container"
            v-if="outfit"
            :class="{ 'outfit-detail--column': fullWidth }"
        >
            <div class="row">
                <div class="col-sm-12 col-md-5" @click="fullWidth = !fullWidth">
                    <img
                        class="img-fluid m-2 d-block mx-auto"
                        :src="outfit.url"
                        alt=""
                    />
                </div>
                <div
                    class="
                        col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 col-xxl-7
                    "
                >
                    <a
                        :href="`/outfits/${outfit.id}/download`"
                        class="btn btn-secondary"
                        title="Download outfit"
                    >
                        <i class="fas fa-download"></i>Download
                    </a>
                    <button
                        class="button--like btn btn-outline-dark"
                        title="Like outfit"
                    >
                        <i class="fas fa-heart"></i>12
                    </button>
                    <br />
                    <br />
                    <p
                        class="description border-bottom"
                        v-text="outfit.description"
                    ></p>
                    <br />
                    <h2 class="outfit-detail-comment font-alt">コメント</h2>
                    <div class="form">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <br />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            outfit: null,
            description: null,
            fullWidth: false,
        };
    },
    created() {
        this.fetchOutfit();
    },
    methods: {
        async fetchOutfit() {
            const response = await axios.get(`/api/outfits/${this.id}`);
            console.log(response);
            this.outfit = response.data;
        },
    },
};
</script>