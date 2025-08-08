<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem} from '@/types';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import Button from '@/components/ui/button/Button.vue';
import { useTodos } from '@/composables/useTodos';
import { useModalStore } from '@/stores/modalStore'

import Show from '@/pages/todo/Show.vue'
import Create from '@/pages/todo/Create.vue'
import Update from '@/pages/todo/Update.vue'

const{
    todos,
    fetchTodos,
    handleDelete,
    handleUpdated,
    handleCreated,
} = useTodos()

const modalStore = useModalStore()

function openTodoModal(id: number) {
    console.log('Opening todo modal for ID:', id);
    modalStore.open(Show, { id: String(id), onDelete: handleDelete, onEdit: openUpdateModal, onUpdated:handleUpdated })
}

function openCreateModal() {
  modalStore.open(Create, { onCreated: handleCreated })
}

function openUpdateModal(id: number) {
  modalStore.open(Update, { id: String(id), onUpdated: handleUpdated })
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Todo List', href: '/todos' },
];

onMounted(async () => {
    try {
        fetchTodos();
    } catch (error) {
        console.error('Error fetching todos:', error);
    }
});
</script>

<template>
    <Head title="To-do's" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4">

            <Button variant="secondary" size="default" class="mb-4" @click="openCreateModal" >
                create todo
            </Button>

            <!-- List of Todos -->
            <ul class="divide-y divide-gray-700 rounded-xl border">
                <li
                    v-for="todo in todos"
                    :key="todo.id"
                    class="p-4 cursor-pointer hover:bg-gray-800"
                    @click="openTodoModal(todo.id)"
                >
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">{{ todo.title }}</span>
                        <span :class="todo.status ? 'text-green-500' : 'text-red-500'">
                            {{ todo.status ? 'Completed' : 'Pending' }}
                        </span>
                    </div>
                </li>
            </ul>

        </div>
    </AppLayout>
</template>
