<script setup>
    import { Head, router, usePage } from "@inertiajs/vue3";
    import MainLayout from "@/Layouts/MainLayout.vue";
    import Pagination from "@/Components/Pagination.vue";
    import ArticleCard from "@/Components/ArticleCard.vue";

    defineProps({
        articles: {
            type: Array,
            default: []
        },
        pagination: {
            type: Array,
            default: []
        },
        tags: {
            type: Array,
            default: []
        },
        currentTag: {
            type: Number,
            default: null
        }
    })

    const props = usePage().props


    const filterByTag = (tag) => {
        props.currentTag = tag
        router.get(route('articles.index'), { tag }, { preserveState: true })
    }

</script>

<template>
    <Head title="Articles" />

    <MainLayout>
        <template #page_title>
            <h1 class="text-4xl text-center text-gray-800 my-10">
                Каталог статей
            </h1>
        </template>

        <div class="flex gap-10 flex-col md:flex-row">

            <aside v-if="tags.length > 0" class="p-4 h-auto md:h-screen sticky top-0 w-full md:w-1/4 bg-white">
                <h2 class="text-lg mb-4">Теги</h2>
                <div class="flex flex-wrap gap-2">
                    <span
                        @click="filterByTag(null)"
                        class="border border-black rounded-xl text-center px-2 cursor-pointer"
                        :class="{
                            'bg-white text-black': currentTag === null,
                            'bg-black text-white': currentTag !== null,
                        }"
                    >
                        Все
                    </span>
                    <span
                        @click="filterByTag(tag.id)"
                        v-for="tag in tags"
                        :key="tag.id"
                        class="border border-black rounded-xl text-center px-2 cursor-pointer"
                        :class="{
                            'bg-white text-black': currentTag === tag.id,
                            'bg-black text-white': currentTag !== tag.id,
                        }"
                    >
                        {{ tag.name }}
                    </span>
                </div>
            </aside>

            <div v-if="articles.length > 0" class="w-full md:w-3/4">
                <div class="flex flex-wrap justify-center gap-6">
                    <ArticleCard v-for="article in articles" :key="article.id" :article="article" />
                </div>

                <div class="flex justify-center mt-8">
                    <Pagination :links="pagination" />
                </div>
            </div>
            <div v-else>
                <div>Статей пока нет</div>
            </div>
        </div>



    </MainLayout>
</template>

<style scoped>

</style>
