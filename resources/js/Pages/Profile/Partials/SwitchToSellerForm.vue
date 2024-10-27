<template>
    <section class="space-y-6">
     <header>
            <h2 class="text-lg font-medium text-gray-900">Switch To seller mode</h2>

            <p class="mt-1 text-sm text-gray-600">
                Button allows you to enter app as the seller, you will be able to post products for sale. Become a partner now.</p>
        </header>
        <SwitchButton @click="switchToSeller">Switch to seller mode</SwitchButton>
    </section>
    </template>

<script setup>
import SwitchButton from '@/Components/SwitchButton.vue';
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
const switchToSeller = () => {
    
    console.log('Sending request to change role...');
    form.role_id = 3;
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