<template>
    <div class="d-inline">
        <router-link class="outfit__overlay" :to="`/outfits/${item.id}`">
            <img
                class="outfit__image col-lg-3 col-md-6 mb-2 p-2"
                :src="item.url"
            />
        </router-link>
    </div>
</template>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
};
</script>