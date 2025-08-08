<script setup lang="ts">
// import AppLayout from '@/layouts/AppLayout.vue';
import { type TodoGroup } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { apiGet } from '@/api/auth';
import Button from '@/components/ui/button/Button.vue';
import { useTodoGroups } from '@/composables/useTodoGroups';
// import { useTodos } from '@/composables/useTodos';

const todoGroup = ref<TodoGroup | null>(null);

const props = defineProps({
    id: {
        type: String,
        required: true,
    },
    // todos: {
    //     type: Array as () => Todo[],
    //     required: true,
    // },
});

const emit = defineEmits(['close', 'delete', 'edit', 'open-todo']);

const { handleShowDelete, handleShowEdit, fetchTodosByGroup, groupOfTodos } = useTodoGroups();

const handleDelete = () => {
    // (id: string, onDelete: (id: string) => void, onClose: () => void) => void
    // Show the delete confirmation modal and handle the delete action + close action
    handleShowDelete(props.id, (id) => emit('delete', id), () => emit('close'));
};

const handleEdit = () => {
    // (id: string, onEdit: (id: string) => void, onClose: () => void) => void
    // Show the edit modal and handle the edit action + close action
    handleShowEdit(props.id, (id) => emit('edit', id), () => emit('close'));
};

onMounted(async () => {
    try {
        const response = await apiGet(`/api/todo-groups/${props.id}`);
        todoGroup.value = response.data;

        await fetchTodosByGroup(Number(props.id));
    } catch (error) {
        console.error('Error fetching todo:', error);
    }
});


</script>

<template>

    <Head title="Show Group" />
    <div v-if="todoGroup" class="p-4 border rounded-xl bg-black-800">
        <h3 class="text-lg font-semibold mb-2">{{ todoGroup.title }}</h3>
        <p class="mb-2">{{ todoGroup.description }}</p>

        <ul class="divide-y divide-gray-700 rounded-xl border">
            <li v-for="todo in groupOfTodos" :key="todo.id" class="p-4 cursor-pointer hover:bg-gray-800"
                @click="$emit('open-todo', todo.id)" >
                <div class="flex items-center justify-between">
                    <span class="font-semibold">{{ todo.title }}</span>
                    <span :class="todo.status ? 'text-green-500' : 'text-red-500'">
                        {{ todo.status ? 'Completed' : 'Pending' }}
                    </span>
                </div>
            </li>
        </ul>

        <div class="flex gap-2 mt-6 justify-end">
            <Button variant="destructive" size="default" @click="handleDelete">
                Delete
            </Button>
            <Button variant="secondary" size="default" @click="handleEdit">
                Edit
            </Button>
        </div>
    </div>
    <div v-else>
        <p>Loading...</p>
    </div>
</template>