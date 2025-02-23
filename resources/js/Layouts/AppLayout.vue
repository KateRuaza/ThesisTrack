<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';

defineProps({
    title: String,
});

const logout = () => {
    router.post(route('logout'));
};

const links = ref([
    { label: 'Borrow Form', icon: '📑', route: 'borrowers.create' },
    { label: 'Record', icon: '📦', route: 'borrowers.index' },
]);

const showingSidebar = ref(false);
const showAccountDropdown = ref(false);

const notify = () => {
    router.post(route('notify'));
    alert('Sending notifications in the background');
};
</script>

<template>
    <Head :title="title" />
    <Banner />

    <div class="flex min-h-screen bg-gray-100 dark:bg-gray-950">
        <div v-if="showingSidebar" class="fixed inset-0 bg-black opacity-50" @click="showingSidebar = false"></div>

        <aside :class="`fixed top-0 left-0 z-40 w-64 h-screen transition-transform bg-white dark:bg-gray-900 ${showingSidebar ? 'translate-x-0' : '-translate-x-full sm:translate-x-0'}`" aria-label="Sidebar">
            <div class="h-full py-4 px-3 overflow-y-auto flex flex-col">
                <div class="">
                    <h2 class="text-lg font-serif dark:text-gray-200 mb-4">ThesisTrack</h2>
                    <ul class="space-y-2 font-medium">
                        <li v-for="(link, index) in links" :key="index">
                            <NavLink class="w-full" :href="route(link.route)" :active="route().current(link.route)">
                                {{ link.icon }} {{ link.label }}
                            </NavLink>
                        </li>
                        <li>
                            <div @click="notify" class="ms-1 cursor-pointer text-sm">📧 Send Notifications
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="pt-4 relative mt-auto">
                    <button @click="showAccountDropdown = !showAccountDropdown" class="flex items-center space-x-2 w-full text-left">
                        <img v-if="$page.props.auth.user.profile_photo_url" class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                        <span class="text-sm font-medium dark:text-gray-200">{{ $page.props.auth.user.name }}</span>
                    </button>
                    <div v-if="showAccountDropdown" class="absolute bottom-full left-0 w-full mb-2 bg-white dark:bg-gray-700 rounded-md shadow-lg z-50">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                            <li>
                                <form @submit.prevent="logout">
                                    <DropdownLink as="button">Log Out</DropdownLink>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 sm:ml-64">
            <main class="min-h-screen">
                <slot />
            </main>
        </div>
    </div>
</template>
