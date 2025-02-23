<script setup>
import { usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const { props } = usePage();
const borrower = props.borrower;
</script>

<template>
    <AppLayout :title="`Borrower: ${borrower.name}`">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Borrower Details
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 w-1/2">
                    <h3 class="text-2xl mb-4">Borrower Information</h3>
                    <div class="space-y-2">
                        <p><strong>Name:</strong> {{ borrower.name }}</p>
                        <p><strong>Email:</strong> {{ borrower.email }}</p>
                        <p><strong>Contact Number:</strong> {{ borrower.contact_number }}</p>
                        <p><strong>Address:</strong> {{ borrower.address }}</p>
                        <p><strong>Thesis Name:</strong> {{ borrower.thesis_name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>