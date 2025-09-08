<script setup lang="ts">
import { useTodosStore } from '@/stores/todoStore'
import { Button } from "@/components/ui/button"
import {
    Drawer,
    DrawerClose,
    DrawerContent,
    DrawerDescription,
    DrawerFooter,
    DrawerHeader,
    DrawerTitle,
    DrawerTrigger,
} from "@/components/ui/drawer"

import { watch } from 'vue'

import { useTextareaAutosize } from '@vueuse/core'
// import { watch } from 'vue'

const todosStore = useTodosStore()

// Autosize for title
const {
    textarea: titleTextArea,
    input: titleInput,
} = useTextareaAutosize({ styleProp: 'minHeight' })

// Autosize for description
const {
    textarea: descTextArea,
    input: descInput,
} = useTextareaAutosize()

watch(
    () => todosStore.selectedTodo,
    (todo) => {
        if (todo) {
            titleInput.value = todo.title ?? ''
            descInput.value = todo.description ?? ''
        }
    },
    { immediate: true }
)
</script>

<template>
    <Drawer direction="right" @update:open="(open) => console.log('Drawer state changed:', open)">
        <DrawerTrigger class="w-full">
            <slot />
        </DrawerTrigger>
        <!-- {{ console.log(todosStore.selectedTodo) }} -->
        <DrawerContent>
            <div class="mx-auto h-full max-w-lg">
                <DrawerHeader>
                    <!-- isEditing = true -->
                    <DrawerTitle v-if="todosStore.selectedTodo">
                        <textarea ref="titleTextArea" v-model="titleInput"
                            class="w-full text-2xl font-bold outline-none resize-none overflow-hidden"
                            :disabled="!todosStore.isEditing" 
                            :class="todosStore.isEditing ? 'border p-2 rounded-md' : 'p-3 rounded-md'"
                            />

                    </DrawerTitle>

                    <!-- isEditing = true -->
                    <DrawerDescription v-if="todosStore.selectedTodo">
                        <textarea ref="descTextArea" v-model="descInput" class="w-full resize-none overflow-hidden"
                            :disabled="!todosStore.isEditing" 
                            :class="todosStore.isEditing ? 'border p-2 rounded-md' : 'p-3 rounded-md'"
                            />
                    </DrawerDescription>

                </DrawerHeader>

                <DrawerFooter>
                    <Button v-if="todosStore.isEditing" :onclick="todosStore.stopEditing">Save</Button>
                    <Button v-if="!todosStore.isEditing" :onclick="todosStore.startEditing">Edit</Button>
                    <DrawerClose>
                        <Button variant="outline">
                            Close
                        </Button>
                    </DrawerClose>
                </DrawerFooter>
            </div>
        </DrawerContent>
    </Drawer>
</template>
