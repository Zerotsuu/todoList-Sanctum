<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { apiGet, apiPut } from '@/api/auth';
import { type Todo } from '@/types';

const props = defineProps<{ id: string; onUpdated?: ()=>void }>();

const emit = defineEmits(['close', 'updated']);

const title = ref('');
const description = ref('');
const status = ref(false);
const error = ref('');

onMounted(async () => {
    try {
        const response = await apiGet(`/api/todos/${props.id}`);
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
        await apiPut(`/api/todos/${props.id}`, {
            title: title.value,
            description: description.value,
            status: status.value,
        });
        
        emit('updated');
        emit('close'); 
    } catch (err: any) {
        error.value = err.response?.data?.message || 'Failed to update todo';
    }
}

function handleCancel() {
    emit('close');
}
</script>

<template>
    <Head title="Update Todo" />
    <form @submit.prevent="updateTodo" class="max-w-xl p-4 border rounded-xl flex flex-col gap-4">
        <div>
            <label class="font-semibold">Title</label>
            <input v-model="title" type="text" class="w-full border rounded p-2" required />
        </div>
        <div>
            <label class="font-semibold">Description</label>
            <textarea v-model="description" class="w-full border rounded p-2" required></textarea>
        </div>
        <div>
            <label class="font-semibold">Status</label>
            <select v-model="status" class="w-full border rounded p-2 bg-gray-600">
                <option :value="false">Pending</option>
                <option :value="true">Completed</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Todo</button>
            <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded" @click="handleCancel">Cancel</button>
        </div>
        <div v-if="error" class="text-red-500">{{ error }}</div>
    </form>
</template>