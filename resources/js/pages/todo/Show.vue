<script setup lang="ts">
// import AppLayout from '@/layouts/AppLayout.vue';
import { type Todo } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { apiGet } from '@/api/auth';
import Button from '@/components/ui/button/Button.vue';
import { useModalStore } from '@/stores/modalStore';
import Update from '@/pages/todo/Update.vue';

const todo = ref<Todo | null>(null);

const props = defineProps({
    id: {
        type: String,
        required: true,
    },
    onDelete: {
        type: Function,
        required: false,
    },
    onEdit: {
        type: Function,
        required: false,
    },
    onUpdated: {
        type: Function,
        required: false,
    },
});

const emit = defineEmits(['close']);

const modalStore = useModalStore();

onMounted(async () => {
    try {
        const response = await apiGet(`/api/todos/${props.id}`);
        todo.value = response.data;
    } catch (error) {
        console.error('Error fetching todo:', error);
    }
});

function handleDelete() {
    if(props.onDelete){
        props.onDelete(props.id);
    } emit('close');
}

function handleEdit() {
    modalStore.open(Update, { id: props.id, onUpdated: props.onUpdated });  
}

</script>

<template>
    <Head title="Show Todo" />
    <div v-if="todo" class="p-4 border rounded-xl bg-black-800">
        <h3 class="text-lg font-semibold mb-2">{{ todo.title }}</h3>
        <p class="mb-2">{{ todo.description }}</p>
        <span :class="todo.status ? 'text-green-500' : 'text-red-500'">
            {{ todo.status ? 'Completed' : 'Pending' }}
        </span>
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