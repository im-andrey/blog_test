<script setup>
defineProps({
    comment: {
        type: Object,
        required: true,
    }
})
</script>

<template>
    <div class="flex items-start space-x-4 p-4 border border-gray-200 rounded-lg shadow-sm bg-white">
        <img
            src="https://via.placeholder.com/40"
            alt="User avatar"
            class="w-10 h-10 rounded-full"
        />
        <div class="flex-1">
            <h3 class="font-bold text-gray-800 text-sm">
                {{ comment.subject }}
            </h3>
            <p class="text-gray-600 text-sm mt-1">
                {{ comment.body }}
            </p>
        </div>
        <div></div>
    </div>
</template>

<style scoped>

</style>
