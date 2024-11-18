<script setup>
import {ref} from "vue";
import CommentForm from "@/Components/Comment/CommentForm.vue";
import CommentsList from "@/Components/Comment/CommentsList.vue";

const props = defineProps({
    articleId: {
        type: Number,
        required: true,
    },
    comments: {
        type: Array,
        default: []
    }
})
const localComments = ref([...props.comments]);

const addComment = (newComment) => {
    localComments.value.unshift(newComment);
};

</script>

<template>
    <hr>
    <div>
        <h1 class="text-2xl text-center text-gray-800 my-5">
            Комментарии
        </h1>
        <div>
            <CommentForm :articleId="articleId" @comment-added="addComment"/>
            <CommentsList :comments="localComments" />
        </div>
    </div>
</template>

<style scoped>

</style>
