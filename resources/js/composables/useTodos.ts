import { ref } from 'vue';
import { apiGet, apiDelete } from '@/api/auth';
import type { Todo } from '@/types';

export function useTodos() {
    const todos = ref<Todo[]>([]);
    const activeModal = ref<'show' | 'create' | 'update' | null>(null);
    const selectedId = ref<number | null>(null);

    async function fetchTodos() {
        try {
            const response = await apiGet('/api/todos');
            todos.value = response.data;
        } catch (error) {
            console.error('Error fetching todos:', error);
        }
    }

    async function handleDelete(id: string) {
        try {
            await apiDelete(`/api/todos/${id}`);
            todos.value = todos.value.filter(todo => String(todo.id) !== id);
        } catch (error) {
            console.error('Failed to delete todo:', error);
        }
        closeModal();
    }


    function handleUpdated() {
        console.log("updated")
        fetchTodos();
        
        
    }

    async function handleCreated() {
        closeModal();
        await fetchTodos();
    }

    function closeModal() {
        // If update modal is open, go back to show modal
        if (activeModal.value === 'update') {
            activeModal.value = 'show';
        } else {
            activeModal.value = null;
            selectedId.value = null;
        }
    }

    return {
        todos,
        selectedId,
        fetchTodos,
        handleDelete,
        handleUpdated,
        handleCreated,
        closeModal,
    };
}