<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import axios from "axios";
import {ref} from "vue";
import Textarea from "@/Components/Textarea.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    articleId: {
        type: Number,
        required: true,
    }
})

const subject = ref("")
const subject_error = ref("")
const comment_body = ref("")
const comment_body_error = ref("")

const isSubmitting = ref(false);

const emit = defineEmits(["comment-added"]);

const createComment = async () => {
    if (isSubmitting.value) return;
    subject_error.value = ""
    comment_body_error.value = ""

    isSubmitting.value = true

    try {
        const response = await axios.post(route('comments.store', {article: props.articleId}), {
            subject: subject.value,
            body: comment_body.value,
        });

        if (response.status === 201) {
            subject.value = ""
            comment_body.value = ""

            const newComment = response.data.comment

            emit("comment-added", newComment);
        }
    } catch(err) {
        subject_error.value = err.response.data.errors.subject ? err.response.data.errors.subject[0] : ""
        comment_body_error.value = err.response.data.errors.body ? err.response.data.errors.body[0] : ""
    } finally {
        isSubmitting.value = false;
    }


}

</script>

<template>
    <form
        @submit.prevent="createComment"
        class="mt-6 space-y-6"
    >
        <div>
            <InputLabel for="subject" value="Тема" />

            <TextInput
                id="subject"
                type="text"
                class="mt-1 block w-full"
                v-model="subject"
                required
                :disabled="isSubmitting"

            />

            <InputError class="mt-2" :message="subject_error" />
        </div>

        <div>
            <InputLabel for="commentBody" value="Комментарий" />

            <Textarea
                id="commentBody"
                v-model="comment_body"
                class="mt-1 block w-full"
                required
                :disabled="isSubmitting"
            />

            <InputError :disabled="isSubmitting" class="mt-2" :message="comment_body_error" />
        </div>

        <SecondaryButton type="submit">
            Опубликовать
        </SecondaryButton>

    </form>
</template>

<style scoped>

</style>
