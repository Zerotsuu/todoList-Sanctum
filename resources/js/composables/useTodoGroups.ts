import { ref } from 'vue';
import { apiGet, apiDelete } from '@/api/auth';
import type { TodoGroup } from '@/types';

export function useTodoGroups() {
    const todoGroups = ref<TodoGroup[]>([]);
    const activeModal = ref<'show' | 'create' | 'update' | 'todo' | null>(null);
    const selectedId = ref<number | null>(null);
    const groupOfTodos = ref<any[]>([])

    async function fetchTodoGroups() {
        try {
            const response = await apiGet('/api/todo-groups');
            todoGroups.value = response.data;
        } catch (error) {
            console.error('Error fetching todos:', error);
        }
    }


    async function fetchTodosByGroup(groupId: number) {
        try {
            const response = await apiGet(`/api/todos/group/${groupId}`);
            groupOfTodos.value = response.data;
        } catch (error) {
            console.error('Error fetching todos:', error);
        }
    }

    async function openTodoGroupModal(todoGroupId: number) {
        console.log("opentodogroupmodal")
        selectedId.value = todoGroupId;
        activeModal.value = 'show';
       
    }
    async function openTodoModal(todoId:number){
        
        selectedId.value = todoId;
        console.log('selected id',todoId)
        activeModal.value = 'todo'

    }

    function openCreateModal() {
        activeModal.value = 'create';
    }

    async function handleDelete(id: string) {
        try {
            await apiDelete(`/api/todo-groups/${id}`);
            todoGroups.value = todoGroups.value.filter(todoGroup => String(todoGroup.id) !== id);
        } catch (error) {
            console.error('Failed to delete todo:', error);
        }
        closeModal();
    }

    function openUpdateModal(id: string) {
        selectedId.value = Number(id);
        activeModal.value = 'update';
    }

    function handleUpdated() {
        closeModal();
        fetchTodoGroups();
    }

    function handleShowDelete(id: string, onDelete: (id: string) => void, onClose: () => void) {
        onDelete(id);
        onClose();
    }

    function handleShowEdit(id: string, onEdit: (id: string) => void, onClose: () => void) {
        onEdit(id);
        onClose();
    }

    async function handleCreated() {
        closeModal();
        await fetchTodoGroups();
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
        todoGroups,
        activeModal,
        selectedId,
        groupOfTodos,
        fetchTodoGroups,
        openTodoModal,
        fetchTodosByGroup,
        openTodoGroupModal,
        openCreateModal,
        handleDelete,
        openUpdateModal,
        handleUpdated,
        handleShowDelete,
        handleShowEdit,
        handleCreated,
        closeModal,
    };
}