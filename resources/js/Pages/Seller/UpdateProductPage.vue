<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Welcome, {{ $page.props.auth.user.name  }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
 
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProductForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                        />
                    </div>
                    
                </div>
            </div>
        </div>
</AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdateProductForm from '../Profile/Partials/UpdateProductForm.vue';

</script>