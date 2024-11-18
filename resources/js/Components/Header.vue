<template>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <Link href="/" class="text-xl font-semibold leading-tight text-gray-800">
                    Т<span class="text-red-600">ред</span>иум
                </Link>

                <nav class="flex gap-8">
                    <Link
                        :class="{'border-red-500': $page.url === '/'}"
                        class="text-gray-800 hover:text-red-500 border-b-2 border-transparent transition-colors duration-300 hover:border-red-500"
                        href="/"
                    >
                        Главная
                    </Link>
                    <Link
                        class="text-gray-800 hover:text-red-500 border-b-2 border-transparent transition-colors duration-300 hover:border-red-500"
                        :class="{'border-red-500': $page.url.startsWith('/articles')}"
                        href="/articles"
                    >
                        Каталог статей
                    </Link>
                </nav>
            </div>



        </div>
    </header>
</template>
<script setup>
import {Link} from "@inertiajs/vue3";

</script>
<style scoped>
.border-red-500 {
    border-color: red !important;
}
</style>
