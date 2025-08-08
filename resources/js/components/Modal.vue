<script setup lang="ts">
import Icon from './Icon.vue';


defineProps<{ visible: boolean }>();
</script>

<template>
  <div
    v-if="visible"
    class="fixed inset-0 bg-black/25 flex items-center justify-center z-50" @click="$emit('close')"
  >
    <div class="bg-gray-600 rounded-xl p-6 min-w-[300px] relative max-w-2xl" @click.stop>
      <button @click="$emit('close')" class="absolute top-2 right-2">
        <Icon name="X" size="32" color="black" stroke-width="3" class="mr-2" />
      </button>
      <slot />
      
    </div>
  </div>
</template>