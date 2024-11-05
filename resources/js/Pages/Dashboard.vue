<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!
                        <p v-if="$page.props.auth.user.role_id === 1">You are logged in as a Moderator</p>

                    <p v-if="$page.props.auth.user.role_id === 3">You are logged in as a Seller</p>

                    </div>
                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
