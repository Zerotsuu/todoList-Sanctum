<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type Todo } from '@/types';
import { Head} from '@inertiajs/vue3';
import { ref, onMounted} from 'vue';
import { apiGet } from '@/api/auth';

const todo = ref<Todo | null>(null);

const props = defineProps({
    id: {
        type: String,
        required: true,
    },
});

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Todo List', href: '/todos' },
    { title: 'Show Todo', href: `/todos/${props.id}` },
];

onMounted(async () => {
    try {
        const response = await apiGet(`/api/todos/${props.id}`);
        todo.value = response.data;
    } catch (error) {
        console.error('Error fetching todo:', error);
    }
});

</script>

<template>
    <Head title="Show Todo" />
    <AppLayout :breadcrumbs="breadcrumbs">
        
        <div v-if="todo" class="p-4 border rounded-xl">
            <h3 class="text-lg font-semibold">{{ todo.title }}</h3>
            <p>{{ todo.description }}</p>
            <span :class="todo.status ? 'text-green-500' : 'text-red-500'">
                {{ todo.status ? 'Completed' : 'Pending' }}
            </span>
        </div>
        <div v-else>
            <p>Loading...</p>
        </div>
    </AppLayout>
</template>