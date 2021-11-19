<template>
    <div>
        <header>
            <Navbar />
        </header>
        <main>
            <div class="container">
                <router-view></router-view>
            </div>
        </main>
        <Footer />
    </div>
</template>

<script>
import Navbar from '../pages/Navbar.vue';
import Footer from '../pages/Footer.vue';

export default {
    components: {
        Navbar,
        Footer,
    },
    watch: {
        $route() {
            $('#navbarCollapse').collapse('hide');
        },
    },
};
</script>