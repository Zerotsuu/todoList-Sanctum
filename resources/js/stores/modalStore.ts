import { defineStore } from 'pinia';
import { Component, markRaw } from 'vue';

interface ModalItem {
  component: Component;
  props: Record<string, any>;
}

export const useModalStore = defineStore('modal', {
  state: () => ({
    stack: [] as ModalItem[],
  }),
  getters: {
    isOpen: (state) => state.stack.length > 0,
    top: (state) => state.stack[state.stack.length - 1] || null,
  },
  actions: {
    open(component: Component, props: Record<string, any> = {}) {
      this.stack.push({ component: markRaw(component), props });
    },
    close() {
      this.stack.pop();
    },
    closeAll() {
      this.stack = [];
    },
  },
});