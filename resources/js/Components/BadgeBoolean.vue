<template>
  <span v-if="props.value" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ props.text }}</span>
  <span v-else class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">{{ props.text }}</span>
</template>

<script setup>

const props = defineProps({
  text: {
    type: String,
    required: true,
  },
  value: {
    type: Boolean,
  },
});
</script>