<script setup lang="ts">
// import AppLayout from '@/layouts/AppLayout.vue';
// import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { apiPost } from '@/api/auth';


// const breadcrumbs: BreadcrumbItem[] = [
//     { title: 'Todo List', href: '/todos' },
//     { title: 'Create Todo', href: '/todos/create' },
// ];

const emit = defineEmits(['created']);
const title = ref('');
const description = ref('');
// const status = ref(false);
const error = ref('');

async function createTodoGroup() {
    try {
        await apiPost('/api/todo-groups', {
            title: title.value,
            description: description.value,
        });
        console.log("created todo-group");
        emit('created');
    } catch (err: any) {
        error.value = err.response?.data?.message || 'Failed to create todo';
    }
}
</script>

<template>
    <Head title="Create Todo Group" />
    <!-- <AppLayout :breadcrumbs="breadcrumbs"> -->
        <form @submit.prevent="createTodoGroup" class="max-w-md mx-auto p-4 border rounded-xl flex flex-col gap-4">
            <div>
                <label class="block font-semibold">Title</label>
                <input v-model="title" type="text" class="w-full border rounded p-2" required />
            </div>
            <div>
                <label class="block font-semibold">Description</label>
                <textarea v-model="description" class="w-full border rounded p-2" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Group</button>
            <div v-if="error" class="text-red-500">{{ error }}</div>
        </form>
    <!-- </AppLayout> -->
</template>
