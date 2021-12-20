<template>
    <div>
        <v-app>
            <Calender />
        </v-app>
    </div>
</template>

<script>
import Calender from './Calender.vue';

export default {
    components: {
        Calender,
    },
};
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}
</style>