<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const form = useForm({
    name: null,
    email: null,
    contact_number: null,
    address: null,
    thesis_name: null,
});

const submit = () => {
    form.post(route('borrowers.store'), {
        onSuccess: () => {
            form.reset();
            alert('Record Saved!');
        },
        onError: (error) => {
            console.error(error); // Consider displaying errors more user-friendly
        }
    });
};
</script>

<template>
    <AppLayout title="Borrower Registration">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Borrower Registration
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit" class="bg-white p-6 space-y-4">
                		<h3 class="text-2xl">Borrow Form</h3>
                    	<div>
                            <InputLabel for="name" value="Name" />
                            <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div>
                            <InputLabel for="email" value="Email" />
                            <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <InputLabel for="contact_number" value="Contact Number" />
                            <TextInput id="contact_number" v-model="form.contact_number" type="tel" class="mt-1 block w-full" required />
                            <InputError class="mt-2" :message="form.errors.contact_number" />
                        </div>

                        <div>
                            <InputLabel for="address" value="Address" />
                            <TextInput id="address" v-model="form.address" type="text" class="mt-1 block w-full" required />
                            <InputError class="mt-2" :message="form.errors.address" />
                        </div>

                        <div>
                            <InputLabel for="thesis_name" value="Thesis Name" />
                            <TextInput id="thesis_name" v-model="form.thesis_name" type="text" class="mt-1 block w-full" required />
                            <InputError class="mt-2" :message="form.errors.thesis_name" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :disabled="form.processing">
                                Submit
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>