<script setup>
const model = defineModel({
    type: String,
    required: true,
})
</script>

<template>
    <textarea
        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        v-model="model"
        ref="textarea"
    />
</template>

<style scoped>

</style>
