<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    links: Array
});

const prev_page_url = computed(() => props.links.find(link => link.label === 'Previous')?.url);
const next_page_url = computed(() => props.links.find(link => link.label === 'Next')?.url);

</script>

<template>
    <nav v-if="links.length > 3" class="flex items-center justify-between mt-4">
        <div class="flex flex-1 justify-between sm:hidden">
            <a v-if="prev_page_url" :href="prev_page_url" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous
            </a>
            <a v-if="next_page_url" :href="next_page_url" class="relative inline-flex items-center ml-3 px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next
            </a>
        </div>
        <div class="hidden sm:flex sm:justify-center">
            <div class="flex">
                <Link v-for="link in links" :key="link.label"
                   :href="link.url"
                   class="relative inline-flex items-center px-2 py-2 border"
                   :class="[
                       link.active ? 'bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                       link.url === null ? 'pointer-events-none' : '' // Disable current page link
                   ]">
                    <span v-html="link.label"></span>
                </Link>
            </div>
        </div>
    </nav>
</template>
