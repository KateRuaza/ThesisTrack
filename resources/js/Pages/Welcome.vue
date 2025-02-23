<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome to ThesisTrack" />

    <div class="relative min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
        <div class="absolute inset-0 bg-gradient-to-b from-indigo-600 to-indigo-900 opacity-75"></div>

        <div class="relative z-10 max-w-4xl w-full px-6 sm:px-12 text-center">
            <h1 class="text-5xl font-extrabold text-white drop-shadow-md">
                ThesisTrack
            </h1>
            <p class="mt-4 text-lg text-gray-300">
                Streamline your thesis tracking with ease and efficiency.
            </p>

            <div v-if="canLogin || canRegister" class="mt-6 flex justify-center space-x-4">
                <Link v-if="canLogin" :href="route('login')" class="px-6 py-2 bg-white text-indigo-700 rounded-lg shadow-md hover:bg-gray-200 transition">
                    Login
                </Link>
            </div>
        </div>
    </div>
</template>
