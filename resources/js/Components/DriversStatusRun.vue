<template>
  <div class="flex justify-between">
    <div>
      <div class="inline-flex">
        <span class="relative flex h-3 w-3">
          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
          <span class="relative inline-flex rounded-full h-3 w-3 bg-green-400"></span>
        </span>
      </div>
      <span class="font-light text-xs pl-2">10 motoristas livres</span>

      <div class="inline-flex ml-4">
        <span class="relative flex h-3 w-3">
          <span class="absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
          <span class="relative inline-flex rounded-full h-3 w-3 bg-red-400"></span>
        </span>
      </div>
      <span class="font-light text-xs pl-2">10 motoristas em serviço</span>
    </div>
  </div>
</template>
<script setup>

const props = defineProps({
  drivers_available: {
    type: Number,
    default: 0
  },
  drivers_in_servive: {
    type: Number,
    default: 0
  }
})

</script>