<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from "@/Layouts/MainLayout.vue";
import Banner from "@/Components/Banner.vue";
import ArticleCard from "@/Components/ArticleCard.vue";

defineProps({
    articles: {
        type: Array,
        default: []
    }
})
</script>

<template>
    <Head title="Home" />
    <MainLayout>
        <template #banner>
            <Banner />
        </template>

        <div v-if="articles.length > 0" class="w-full mt-8">
            <div class="flex flex-wrap justify-center gap-6">
                <ArticleCard v-for="article in articles" :key="article.id" :article="article" />
            </div>
        </div>

    </MainLayout>
</template>
