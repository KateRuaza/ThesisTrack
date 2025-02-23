<script setup>
import { formatDate } from '@/helper.js';
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { computed } from 'vue';

const props = defineProps({
    borrowers: Object,
});

const hasPagination = computed(() => props.borrowers.links && props.borrowers.links.length > 3);
</script>

<template>
    <AppLayout title="Borrowers List">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Borrowers List
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 overflow-x-auto">
                        <div class="w-full overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thesis Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="borrower in borrowers.data" :key="borrower.id" class="bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">{{ borrower.name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ borrower.thesis_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ formatDate(borrower.created_at) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-3 py-1 rounded-full text-white text-xs font-semibold"
                                                :class="{
                                                    'bg-green-400': borrower.status === 'active',
                                                    'bg-blue-400': borrower.status === 'returned',
                                                    'bg-yellow-400': borrower.status === 'not_returned',
                                                    'bg-red-400': borrower.status === 'late'
                                                }">
                                                {{ borrower.status.replace('_', ' ') }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr v-if="borrowers.data.length === 0">
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-400">No borrowers found.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-if="hasPagination" class="mt-4">
                            <Pagination :links="borrowers.links" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
