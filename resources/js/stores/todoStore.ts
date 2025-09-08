import { defineStore } from 'pinia';
import type { Todo } from '@/types';
import { apiGet } from '@/api/auth'

export const useTodosStore = defineStore('todos', {
  state: () => ({
    todos: [] as Todo[],
    selectedTodo: null as Todo | null,
    isEditing : false,
  }),
  actions: {
    async fetchTodos() {
      const response = await apiGet<Todo[]>('/api/todos')
      this.todos = response.data
    },
    setSelected(todo: Todo) {
      this.selectedTodo = todo
    },
    startEditing(){
      this.isEditing = true
    },
    stopEditing(){
      this.isEditing = false
    }
  },
});
