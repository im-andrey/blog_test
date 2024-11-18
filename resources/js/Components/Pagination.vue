<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    links: {
        type: Array,
        default: []
    }
})
</script>

<template>
    <div v-if="links.length > 0">
        <div class="flex flex-wrap mb-1">
            <template v-for="(link, index) in links" :key="index">
                <div
                    v-if="link.url === null"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                    v-html="link.label"
                >
                </div>

                <Link
                    v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded focus:border-indigo-500 inline-block focus:text-indigo-500"
                    :class="{'bg-red-700 text-white': link.active}"
                    :href="link.url">

                    <span v-html="link.label"></span>
                </Link>

            </template>
        </div>
    </div>
</template>

<style scoped>

</style>
