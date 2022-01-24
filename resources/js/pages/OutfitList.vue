<template>
    <div class="outfit-list">
        <h2>タイムライン</h2>
        <div class="grid">
            <Outfit
                class="list-item"
                v-for="outfit in outfits"
                :key="outfit.id"
                :item="outfit"
            />
        </div>
    </div>
</template>

<script>
import Outfit from './outfit/Outfit.vue';

export default {
    components: {
        Outfit,
    },
    data() {
        return {
            outfits: [],
        };
    },
    methods: {
        async fetchOutfits() {
            const response = await axios.get('/api/outfits');

            console.log(response);
            this.outfits = response.data.outfits;
        },
    },
    watch: {
        $route: {
            async handler() {
                await this.fetchOutfits();
            },
            immediate: true,
        },
    },
};
</script>