<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { apiGet, apiPut } from '@/api/auth';
import { type TodoGroup } from '@/types';

const props = defineProps<{ id: string }>();
const emit = defineEmits(['updated']);

const title = ref('');
const description = ref('');
const status = ref(false);
const error = ref('');

onMounted(async () => {
    try {
        const response = await apiGet(`/api/todo-groups/${props.id}`);
        const todoGroup: TodoGroup = response.data;
        title.value = todoGroup.title;
        description.value = todoGroup.description;
    } catch (err: any) {
        error.value = err.response?.data?.message || 'Failed to fetch todo group';
    }
});

async function updateTodoGroup() {
    try {
        await apiPut(`/api/todo-groups/${props.id}`, {
            title: title.value,
            description: description.value,
            status: status.value,
        });
        emit('updated');
    } catch (err: any) {
        error.value = err.response?.data?.message || 'Failed to update todo group';
    }
}
</script>

<template>
    <Head title="Update Todo" />
    <form @submit.prevent="updateTodoGroup" class="max-w-xl p-4 border rounded-xl flex flex-col gap-4">
        <div>
            <label class="font-semibold">Title</label>
            <input v-model="title" type="text" class="w-full border rounded p-2" required />
        </div>
        <div>
            <label class="font-semibold">Description</label>
            <textarea v-model="description" class="w-full border rounded p-2" required></textarea>
        </div>
        <div>

        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Todo Group</button>
        <div v-if="error" class="text-red-500">{{ error }}</div>
    </form>
</template>