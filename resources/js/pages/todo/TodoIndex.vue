<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem} from '@/types';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import TodoDrawer from '@/components/todoDrawer/TodoDrawer.vue';
import { columns } from '@/components/todos/columns';
import { useTodosStore } from '@/stores/todoStore';
import DataTable from '@/components/todos/data-table.vue';

const todoStore = useTodosStore()

// const todos = ref<Todo[]>([])
// const selectedTodo = ref<Todo|null>(null)

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Todo List', href: '/todos' },
];


onMounted(async () => {
    try {
        await todoStore.fetchTodos();
        
        
    } catch (error) {
        console.error('Error fetching todos:', error);
    }
});

</script>

<template>

    <Head title="To-do's" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4">

            <!-- List of Todos -->
            <ul class="divide-y divide-gray-700 rounded-xl border">
                <TodoDrawer>
                    <DataTable :data="todoStore.todos" :columns="columns" @rowClick="todoStore.setSelected"/>
                </TodoDrawer>
            </ul>

        </div>
    </AppLayout>
</template>
