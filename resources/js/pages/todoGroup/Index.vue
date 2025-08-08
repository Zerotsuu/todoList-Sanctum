<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem} from '@/types';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import Modal from '@/components/Modal.vue';
import Show from '@/pages/todoGroup/Show.vue';
import Button from '@/components/ui/button/Button.vue';
import Create from '@/pages/todoGroup/Create.vue';
import { useTodoGroups } from '@/composables/useTodoGroups';
import Update from '@/pages/todoGroup/Update.vue';

import TodoShow from '@/pages/todo/Show.vue';

const{
    todoGroups,
    activeModal,
    selectedId,
    // groupOfTodos,
    openTodoGroupModal,
    openCreateModal,
    openTodoModal,
    handleDelete,
    openUpdateModal,
    handleUpdated,
    handleCreated,
    closeModal,
    fetchTodoGroups,
} = useTodoGroups();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Todo Groups', href: '/todo-groups' },
];

onMounted(async () => {
    try {
        fetchTodoGroups();
        console.log('fetchtodogroups()');
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
                Create Group
            </Button>

            <!-- List of TodoGroups -->
            <ul class="divide-y divide-gray-700 rounded-xl border">
                <li
                    v-for="todoGroup in todoGroups"
                    :key="todoGroup.id"
                    class="p-4 cursor-pointer hover:bg-gray-800"
                    @click="openTodoGroupModal(todoGroup.id)"
                >
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">{{ todoGroup.title }}</span>
                    </div>
                </li>
            </ul>

        </div>

        <Modal :visible="activeModal === 'show'" @close="closeModal">
            <Show v-if="selectedId !== null" :id="String(selectedId)" @delete="handleDelete" @edit="openUpdateModal" @open-todo="openTodoModal"/>
        </Modal>

        <Modal :visible="activeModal === 'create'" @close="closeModal">
            <Create @created="handleCreated"/>
        </Modal>

        <Modal :visible="activeModal === 'update'" @close="closeModal">
            <Update v-if="selectedId !== null" :id="String(selectedId)" @updated="handleUpdated" />
        </Modal>

        <Modal :visible="activeModal === 'todo'" @close="closeModal">
            <TodoShow v-if="selectedId !== null" :id="String(selectedId)" @delete="handleDelete" @edit="openUpdateModal"/>
        </Modal>

    </AppLayout>
</template>
