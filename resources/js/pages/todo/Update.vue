<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type Todo } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { apiGet, apiPost } from '@/api/auth';


const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Todo List', href: '/todos' },
    { title: 'Update Todo', href: `/todos/${route.params.id}/update` },
];

const title = ref('');
const description = ref('');
const status = ref(false);
const error = ref('');

onMounted(async () => {
    try {
        const response = await apiGet(`/api/todos/${route.params.id}`);
        const todo: Todo = response.data;
        title.value = todo.title;
        description.value = todo.description;
        status.value = todo.status;
    } catch (err: any) {
        error.value = err.response?.data?.message || 'Failed to fetch todo';
    }
});

async function updateTodo() {
    try {
        await apiPost(`/api/todos/${route.params.id}`, {
            title: title.value,
            description: description.value,
            status: status.value,
            _method: 'PUT', // For Laravel to treat as PUT
        });
    } catch (err: any) {
        error.value = err.response?.data?.message || 'Failed to update todo';
    }
}
</script>

<template>
    <Head title="Update Todo" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <form @submit.prevent="updateTodo" class="max-w-md mx-auto p-4 border rounded-xl flex flex-col gap-4">
            <div>
                <label class="block font-semibold">Title</label>
                <input v-model="title" type="text" class="w-full border rounded p-2" required />
            </div>
            <div>
                <label class="block font-semibold">Description</label>
                <textarea v-model="description" class="w-full border rounded p-2" required></textarea>
            </div>
            <div>
                <label class="block font-semibold">Status</label>
                <select v-model="status" class="w-full border rounded p-2">
                    <option :value="false">Pending</option>
                    <option :value="true">Completed</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Todo</button>
            <div v-if="error" class="text-red-500">{{ error }}</div>
        </form>
    </AppLayout>
</template>