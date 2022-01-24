<template>
    <div>
        <h2>Outfit Detail</h2>
        <div
            class="container"
            v-if="outfit"
            :class="{ 'outfit-detail--column': fullWidth }"
        >
            <div class="row">
                <div
                    class="col-sm-12 col-md-5 p-0 mb-3"
                    @click="fullWidth = !fullWidth"
                >
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
                        class="btn btn-outline-secondary"
                        title="Download outfit"
                    >
                        <i class="fas fa-download"></i> Download
                    </a>
                    <button
                        class="button--like btn btn-outline-dark"
                        :class="{
                            'button--liked': outfit.favorite_by_user,
                        }"
                        title="Favorite outfit"
                        @click="onFavoriteClick"
                    >
                        <i class="fas fa-heart"></i>
                        {{ outfit.favorites_count }}
                    </button>
                    <br />
                    <br />
                    <p
                        class="description border-bottom"
                        v-text="outfit.description"
                    ></p>
                    <br />
                    <h2 class="outfit-detail-comment font-alt">
                        <i class="fas fa-comments"></i>コメント
                    </h2>
                    <form class="form" @submit.prevent="addComment">
                        <textarea
                            class="form-control"
                            v-model="commentContent"
                            rows="3"
                        ></textarea>
                        <div class="form__button text-right mt-2">
                            <button
                                type="submit"
                                class="btn btn-dark text-white"
                            >
                                コメントする
                            </button>
                        </div>
                    </form>
                    <br />
                    <ul
                        v-if="outfit.comments.length > 0"
                        class="
                            outfit-detail-comments
                            list-unstyled list-group-flush
                        "
                    >
                        <li
                            v-for="comment in outfit.comments"
                            :key="comment.content"
                            class="outfit-detail__commentItem list-group-item"
                        >
                            <div class="d-flex justify-content-between">
                                <p class="outfit-detail__commentBody">
                                    {{ comment.content }}
                                </p>
                                <p class="outfit-detail__commentUser">
                                    {{ comment.author.name }}
                                </p>
                            </div>
                        </li>
                    </ul>
                    <p v-else>コメントはまだありません</p>
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
            commentContent: '',
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
        async addComment() {
            const response = await axios.post(
                `/api/outfits/${this.id}/comments`,
                {
                    content: this.commentContent,
                }
            );

            this.commentContent = '';

            this.outfit.comments = [response.data, ...this.outfit.comments];
        },
        onFavoriteClick() {
            if (this.outfit.favorite_by_user) {
                this.deleteFavorite();
            } else {
                this.favorite();
            }
        },
        async favorite() {
            const response = await axios.put(
                `/api/outfits/${this.id}/favorite`
            );

            console.log(response);

            this.outfit.favorites_count = this.outfit.favorites_count + 1;
            this.outfit.favorite_by_user = true;
        },
        async deleteFavorite() {
            const response = await axios.delete(
                `/api/outfits/${this.id}/favorite`
            );

            console.log(response);

            this.outfit.favorites_count = this.outfit.favorites_count - 1;
            this.outfit.favorite_by_user = false;
        },
    },
    watch: {
        $route: {
            async handler() {
                await this.fetchOutfit();
            },
            immediate: true,
        },
    },
};
</script>