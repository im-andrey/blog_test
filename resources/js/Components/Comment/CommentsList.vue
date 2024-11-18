<script setup>
import Comment from "@/Components/Comment/Comment.vue";

defineProps({
    comments: {
        type: Array,
        default: []
    }
})
</script>

<template>
    <hr class="mt-5">
    <transition-group
        v-if="comments.length > 0"
        class="w-full flex flex-col gap-3 mt-8"
        tag="div"
        name="fade"
    >
        <Comment class="w-full" v-for="comment in comments" :comment="comment" />
    </transition-group>
</template>

<style scoped>
/* Эффект плавного появления */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
