
<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Welcome, {{ $page.props.auth.user.name  }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!

                    </div>
                    
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <tr v-for="user in users">

                        <td className="border px-4 py-2">{{ user.id }}</td>
                        <td className="border px-4 py-2">{{ user.name }}</td>
                        <td className="border px-4 py-2">{{ user.role_id }}</td>
                                    

                    </tr>
                    <tr v-for="seller in sellers">
                        <td className="border px-4 py-2">{{ seller.id }}</td>
                        <td className="border px-4 py-2">{{ seller.name }}</td>
                        <td className="border px-4 py-2">{{ seller.role_id }}</td>
                    </tr>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <ProductStats></ProductStats>
                                        
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ProductStats from './ProductStats.vue';

defineProps({
    users: Array,
    sellers: Array,
});
</script>
