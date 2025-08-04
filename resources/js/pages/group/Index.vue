<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type Todo } from '@/types';
import { Head ,router } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { apiGet } from '@/api/auth';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Todo List', href: '/todos' },
];
const todos = ref<Todo[]>([]);

function goToTodo(todoId: number) {
    router.visit(`/todos/${todoId}`);
}

onMounted(async () => {
    try {
        const response = await apiGet('/api/todos');
        todos.value = response.data;
    } catch (error) {
        console.error('Error fetching todos:', error);
    }
});
</script>

<template>
    <Head title="To-do's" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4">
            <ul class="divide-y divide-gray-700 rounded-xl border">
                <li
                    v-for="todo in todos"
                    :key="todo.id"
                    class="p-4 cursor-pointer hover:bg-gray-800"
                    @click="goToTodo(todo.id)"
                >
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">{{ todo.title }}</span>
                    <!-- <span>{{ todo.description }}</span> -->
                    <span :class="todo.status ? 'text-green-500' : 'text-red-500'">
                        {{ todo.status ? 'Completed' : 'Pending' }}
                    </span>
                    </div>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
