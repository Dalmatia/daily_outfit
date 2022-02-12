<template>
    <div>
        <i
            class="fas fa-user-plus follow btn btn-primary"
            @click.prevent="followUser"
            v-text="buttonText"
        ></i>
    </div>
</template>
<script>
export default {
    props: ['userId', 'follows'],
    data() {
        return {
            status: this.follows,
        };
    },
    methods: {
        followUser() {
            axios
                .post('/api/follow', {
                    userId: this.userId,
                })
                .then((response) => {
                    this.status = !this.status;
                    console.log(response);
                })
                .catch((error) => {
                    alert('エラーです');
                });
        },
    },
    computed: {
        buttonText() {
            return this.status ? 'フォロー解除' : 'フォローする';
        },
    },
};
</script>
<style scoped>
.follow {
    display: inline-block;
    border: 1px solid #cfcabf;
    border-radius: 5%;
    padding: 7px;
    cursor: pointer;
}
.unfollow {
    display: inline-block;
    border: 1px solid #cfcabf;
    border-radius: 5%;
    padding: 7px;
    cursor: pointer;
}
.unfollow:hover {
    background-color: #2983fd;
    color: #fff;
}
.follow:hover {
    background-color: #2983fd;
    color: #fff;
}
</style>