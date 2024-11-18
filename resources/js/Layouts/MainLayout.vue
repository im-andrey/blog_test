<script setup>
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";
</script>

<template>
    <Header />

    <slot name="banner" />
    <div class="container mx-auto mb-20">

        <slot name="page_title"/>

        <slot />
    </div>
    <Footer />
</template>

<style scoped>

</style>
