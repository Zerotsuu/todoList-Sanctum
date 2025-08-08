<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { useModalStore } from '@/stores/modalStore';
import Modal from '@/components/Modal.vue'

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const modalStore = useModalStore();
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
        <template v-for="(modal, idx) in modalStore.stack" :key="idx">
            <Modal :visible="idx === modalStore.stack.length - 1" @close="modalStore.close">
                <component
                    :is="modal.component"
                    v-bind="modal.props"
                    @close="modalStore.close"
                />
            </Modal>
        </template>
    </AppLayout>
</template>
