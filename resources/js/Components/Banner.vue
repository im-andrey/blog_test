<script setup>
defineProps({
    title: {
        type: String,
        default: 'Добро пожаловать в Тредиум'
    },
    subtitle: {
        type: String,
        default: 'Как перестать прокрастинировать и начать жить'
    }
})
</script>

<template>
    <section class="bg-gray-200 py-16 px-4">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold text-gray-900">{{ title }}</h1>
            <p class="text-xl mt-4 text-gray-700">
                {{ subtitle }}
            </p>
        </div>
    </section>
</template>

<style scoped>

</style>
