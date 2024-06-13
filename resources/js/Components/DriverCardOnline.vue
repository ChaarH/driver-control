<template>
  <div class="py-8 px-8 max-w-md bg-white rounded-xl shadow-lg space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6 mb-2 border-red-800">
    <img class="block mx-auto h-24 rounded-full sm:mx-0 sm:shrink-0" :src="props.avatar">
    <div class="text-center space-y-2 sm:text-left">
      <div class="space-y-0.5">
        <p class="text-lg text-black font-semibold">
          {{ props.name }}
        </p>
        <div class="inline-flex">
        <span class="relative flex h-3 w-3">
          <span :class="bagdeDriverStatus.badge_1"></span>
          <span :class="bagdeDriverStatus.bagde_2"></span>
        </span>
        </div>
        <span class="font-light text-xs pl-2">{{ driverStatus }}</span>
      </div>
      <button v-if="props.online && !props.in_run" class="inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-3 py-1 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:w-auto">Selecionar</button>
      <button v-if="props.online && props.in_run" class="inline-flex items-center justify-center rounded-md border border-transparent bg-green-400 px-3 py-1 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:w-auto">Liberar</button>
    </div>
  </div>
</template>

<script setup>
import {computed, ref} from 'vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ThumbsUpIcon from "@/Components/Icons/ThumbsUpIcon.vue";
import ThumbsDownIcon from "@/Components/Icons/ThumbsDownIcon.vue";
import StarsIcon from "@/Components/Icons/StarsIcon.vue";
import MenuDriverIcon from "@/Components/Icons/MenuIcons/MenuDriverIcon.vue";

const props = defineProps({
  name: {
    type: String
  },
  online: {
    type: Boolean
  },
  in_run: {
    type: Boolean
  },
  avatar: {
    type: String
  }
})

const driverStatus = computed(() => {
  return props.online && props.in_run
    ? 'Ocupado' : 'Disponível'
})

const bagdeDriverStatus = computed(() => {
  return props.online && !props.in_run
      ? { badge_1 : 'animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75', bagde_2: 'relative inline-flex rounded-full h-3 w-3 bg-green-400' }
      : { badge_1 : 'absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75', bagde_2: 'relative inline-flex rounded-full h-3 w-3 bg-red-400' }
})

</script>