<script setup>

import LikeButton from "@/Components/LikeButton.vue";
import {EyeIcon} from "@heroicons/vue/24/outline/index.js";
import {Link} from "@inertiajs/vue3";

defineProps({
    article: {
        type: Object,
        required: true,
    }
})
</script>

<template>
    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
        <img class="w-full h-48 object-cover" src="https://via.placeholder.com/400x200" alt="Article Image">
        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ article.title }}</h3>

            <div class="flex justify-between mb-4">
                <LikeButton
                    :initialLikesCount="article.likes_count"
                    :articleId="article.id"
                    :isLiked="article.liked_by_me" />

                <div class="flex gap-1 cursor-pointer">
                    <EyeIcon class="size-6" />
                    <span>{{ article.views }}</span>
                </div>
            </div>

            <div v-if="article.tags.length > 0" class="flex flex-wrap gap-2 mb-4">
                <span class="bg-black px-2 rounded-xl text-white" v-for="tag in article.tags" :key="tag.id">
                    {{ tag.name }}
                </span>
            </div>

            <Link :href="'/articles/' + article.slug" class="text-black-600 hover:text-black-800 transition-all duration-300">Читать статью</Link>
        </div>
    </div>
</template>

<style scoped>

</style>
