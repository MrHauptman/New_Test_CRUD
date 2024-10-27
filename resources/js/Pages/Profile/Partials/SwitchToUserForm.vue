<template>
    <section class="space-y-6">
     <header>
            <h2 class="text-lg font-medium text-gray-900">Switch To user mode</h2>

            <p class="mt-1 text-sm text-gray-600">
                Button allows you to enter app as the user, you will be able to buy products. Become a customer now.</p>
        </header>
        <SwitchButtonSecond @click="switchToUser">Switch to user mode</SwitchButtonSecond>
    </section>
    </template>

<script setup>
import SwitchButtonSecond from '@/Components/SwitchButtonSecond.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
name: '',
email: '',
})

// const switchToSeller = () => {
//     form.patch(route('profile.changeMode'), {
//         preserveScroll: true,
//         onSuccess: () => form.reset(),
//     });
    

// };
const switchToUser = () => {
    
    console.log('Sending request to change role...');
    form.role_id = 2;
    form.patch(route('profile.changeMode'), {
        preserveScroll: true,
        onSuccess: () => {
            console.log('Success!');
            form.reset()
        },
        onError: (errors) => {
            console.log('Errors:', errors);
        }
    });
};




</script>