<template>
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">© {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </footer>
</template>

<script>
    export default {
        name: 'Footer',

        setup() {
            return {
                date: () => new Date().getFullYear(),
            };
        }
    };

</script>

<style scoped>
    footer {
        position: relative;
        width: 100%;
    }

</style>
