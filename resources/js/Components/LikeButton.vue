<script setup>
import { ref } from 'vue';
import {HeartIcon} from "@heroicons/vue/24/outline/index.js";
import axios from "axios";

const props = defineProps({
    articleId: {
        type: Number,
        required: true
    },
    initialLikesCount: {
        type: Number,
        required: true
    },
    isLiked: {
        type: Boolean,
        default: false
    }
})

const likesCount = ref(props.initialLikesCount);
const liked = ref(props.isLiked);
const toggleLike = async () => {
    try {

        const response = await axios.post(route('articles.toggleLike', {article: props.articleId}))

        if (response.status === 200) {
            liked.value = !liked.value
            likesCount.value = response.data.count
        }
    } catch (error) {
        console.error('Ошибка при попытке поставить/снять лайк:', error);
    }
}
</script>

<template>
    <div @click="toggleLike" class="flex gap-1 cursor-pointer">
        <HeartIcon :class="liked ? 'text-red-500' : 'text-gray-500'" class="size-6" />
        <span :class="liked ? 'text-red-500' : 'text-gray-500'">{{ likesCount }}</span>
    </div>
</template>

<style scoped>

</style>
