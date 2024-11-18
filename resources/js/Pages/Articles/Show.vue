<script setup>
import {Head} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import {EyeIcon, HeartIcon} from "@heroicons/vue/24/outline/index.js";
import LikeButton from "@/Components/LikeButton.vue";
import CommentBlock from "@/Components/Comment/CommentBlock.vue";
import { onMounted, onBeforeUnmount, ref } from "vue";

const props = defineProps({
    article: {
        type: Object,
        default: {}
    }
})

let timer = null;
const isTimeElapsed = ref(false);
const localArticleViews = ref(props.article.views)

const startTimer = () => {
    timer = setTimeout(() => {
        isTimeElapsed.value = true;

        axios.post(route("articles.incrementViews", { id: props.article.id }))
            .then(() => {
                localArticleViews.value++
                console.log("Просмотр статьи увеличен");
            })
            .catch(err => {
                console.error("Ошибка увеличения просмотров:", err);
            });
    }, 5000); // Ждём 5 секунд
};

const clearTimer = () => {
    if (timer) clearTimeout(timer);
};


onMounted(() => {
    startTimer();
});

onBeforeUnmount(() => {
    clearTimer();
});

</script>

<template>
    <Head :title="article.title" />
    <MainLayout>
        <img class="w-full" src="https://via.placeholder.com/1200x600" alt="">

        <div class="p-4">
            <h1 class="text-4xl font-bold text-gray-800 my-6">
                {{ article.title }}
            </h1>
            <div class="flex gap-4 my-4">
                <LikeButton
                    :initialLikesCount="article.likes_count"
                    :articleId="article.id"
                    :isLiked="article.liked_by_me"
                />

                <div class="flex gap-1 cursor-pointer">
                    <EyeIcon class="size-6" />
                    <span>{{ localArticleViews }}</span>
                </div>
            </div>


            <div v-if="article.tags.length > 0" class="flex flex-wrap gap-2 mb-4">
            <span class="bg-black px-2 rounded-xl text-white" v-for="tag in article.tags" :key="tag.id">
                {{ tag.name }}
            </span>
            </div>

            <p class="mb-4" v-html="article.body"></p>

            <CommentBlock :comments="article.comments" :articleId="article.id" />
        </div>

    </MainLayout>
</template>

<style scoped>

</style>
