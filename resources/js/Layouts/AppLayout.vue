<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
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
]);

const showingSidebar = ref(false);
const showAccountDropdown = ref(false);
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
                                <DropdownLink :href="route('profile.show')">Profile</DropdownLink>
                            </li>
                            <li v-if="$page.props.jetstream.hasApiFeatures">
                                <DropdownLink :href="route('api-tokens.index')">API Tokens</DropdownLink>
                            </li>
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
                <!-- <header v-if="$slots.header" class="bg-indigo-950 dark:bg-gray-900 flex items-center justify-between px-6 py-4">
                    <slot name="header" />
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                            </button>
                            <span v-else class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ $page.props.auth.user.name }}
                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                        </template>
                        <template #content>
                            <div class="block px-4 py-2 text-xs text-gray-400">Manage Account</div>
                            <DropdownLink :href="route('profile.show')">Profile</DropdownLink>
                            <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">API Tokens</DropdownLink>
                            <div class="border-t border-gray-200" />
                            <form @submit.prevent="logout">
                                <DropdownLink as="button">Log Out</DropdownLink>
                            </form>
                        </template>
                    </Dropdown>
                </header> -->
                <slot />
            </main>
        </div>
    </div>
</template>
