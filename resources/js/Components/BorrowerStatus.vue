<script setup>
defineProps({
    borrower: {
        type: Object,
        required: true,
    },
    showPopup: {
    	required: true
    },
});

defineEmits(['togglePopup', 'updateStatus']);
</script>

<template>
    <div class="">
        <span @click="$emit('togglePopup', borrower.id)" class="px-3 py-1 rounded-full text-white text-xs font-semibold cursor-pointer"
            :class="{
                'bg-green-400': borrower.status === 'active',
                'bg-blue-400': borrower.status === 'returned',
                'bg-yellow-400': borrower.status === 'not_returned',
                'bg-red-400': borrower.status === 'late'
            }">
            {{ borrower.status.replace('_', ' ') }}
        </span>

        <div v-if="showPopup === borrower.id" class="absolute mt-2 w-40 bg-white dark:bg-gray-700 shadow-lg rounded-lg p-2 z-20">
            <button @click="$emit('updateStatus', borrower, 'returned')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Returned</button>
            <button @click="$emit('updateStatus', borrower, 'not_returned')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">Not Returned</button>
        </div>
    </div>
</template>
