<template>
    <div>
        <div v-if="followed">フォローされてます</div>
        <form @submit.prevent="send" class="mb-1">
            <input type="hidden" name="_token" v-bind:value="csrf" />
            <div v-if="following_check">
                <button type="submit" class="btn btn-primary text-light btn-sm">
                    <i class="fas fa-user-check"></i>
                    フォロー解除
                </button>
            </div>
            <div v-else>
                <button type="submit" class="btn btn-primary text-light btn-sm">
                    <i class="fas fa-user-plus"></i>
                    フォローする
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            url: '',
        };
    },
    props: [
        'user_id',
        'csrf',
        'following',
        'followed',
        'toggleFollow',
    ],
    computed: {
        following_check: {
            get() {
                return this.$store.state.follow.following_check;
            },
            set() {
                this.check_follow();
            },
        },
    },
    created() {
        this.first_check();
    },
    methods: {
        first_check() {
            if (this.following == 1) {
                this.following_check = true;
            }
        },
        check_follow() {
            this.$store.dispatch('follow/follow_check', this.user_id);
        },
        send() {
            this.$store.dispatch('follow/follow_do', this.user_id);
            this.check_follow();
            this.$emit('toggleFollow');
        },
    },
};
</script>