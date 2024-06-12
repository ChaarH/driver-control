<template>
  <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20">{{ roles[props.role] }}</span>
</template>

<script setup>

const roles = {
  1: 'Administrador',
  2: 'Operador',
}

const props = defineProps({
  role: {
    type: String,
    required: true
  }
});
</script>