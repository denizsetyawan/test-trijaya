<template>
    <div class="d-flex flex-column min-vh-100">
        <Header />

        <main class="flex-fill">
            <slot />
        </main>

        <Footer class="mt-auto" />
    </div>
</template>

<script>
    import Header from '../Components/Header.vue';
    import Footer from '../Components/Footer.vue';

    export default {
        components: {
            Header,
            Footer,
        },
    };

</script>

<style scoped>
    footer {
        background-color: #f8f9fa;
        padding: 20px 0;
    }

</style>
