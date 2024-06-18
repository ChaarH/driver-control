<template>
  <div :class="dinamicBorder">
    <div class="flex flex-inline w-full">
      <div class="py-2">
        <img class="block mx-auto h-18 rounded-full sm:mx-0 sm:shrink-0" :src="props.avatar">
      </div>
      <div class="text-center space-y-2 sm:text-left w-3/4">
      <div class="space-y-0.5 pl-4">
        <p class="text-lg text-black font-semibold">
          {{ formattedDriverName }}
        </p>
        <div class="inline-flex">
        <span class="relative flex h-3 w-3">
          <span :class="bagdeDriverStatus.badge_1"></span>
          <span :class="bagdeDriverStatus.bagde_2"></span>
        </span>
        </div>
        <span class="font-light text-xs pl-2">{{ driverStatus }}</span>
      </div>
      <div class="w-full flex">
        <div class="pt-1 pl-4 w-2/4">
          <button v-if="props.online && !props.in_run" class="inline-flex items-center justify-center text-xs rounded-md border border-transparent bg-green-400 px-3 py-1 font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:w-auto">Iniciar corrida</button>
          <button v-else class="inline-flex items-center justify-center text-xs rounded-md border border-transparent bg-red-500 px-3 py-1 font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:w-auto">Encerrar</button>
        </div>
        <div class="flex w-2/4 justify-end text-xs pl-1">
          <ul class="text-gray-700 flex items-center justify-between float-right w-full">
            <li class="flex flex-col items-center justify-around text-gray-700">
              <StarsIcon />
              <div>4.5</div>
            </li>
            <li class="flex flex-col items-center justify-around text-gray-700">
              <TruckIcon />
              <div>2k</div>
            </li>
            <li class="flex flex-col items-center justify-around text-gray-700">
              <ThumbsUpIcon />
              <div>10k</div>
            </li>
            <li class="flex flex-col items-center justify-around text-gray-700">
              <ThumbsDownIcon />
              <div>15</div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    </div>
    <div class="w-full">
      <CountdownTimer :initial_time="props.time_last_run" :in_run="props.in_run" />
    </div>
  </div>
</template>

<script setup>
import {computed, onMounted, ref} from 'vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ThumbsUpIcon from "@/Components/Icons/ThumbsUpIcon.vue";
import ThumbsDownIcon from "@/Components/Icons/ThumbsDownIcon.vue";
import StarsIcon from "@/Components/Icons/StarsIcon.vue";
import MenuDriverIcon from "@/Components/Icons/MenuIcons/MenuDriverIcon.vue";
import TruckIcon from "@/Components/Icons/TruckIcon.vue";
import CountdownTimer from "@/Components/CountdownTimer.vue";

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
  },
  time_last_run: String
})

const formattedDriverName = computed(() => {
  let split_name = props.name.split(' ')

  return split_name.length > 1
    ? `${split_name[0]} ${split_name[1]}`
    : split_name[0]
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

const dinamicBorder = computed(() => {
  return props.online && !props.in_run
      ? 'flex flex-wrap py-8 px-8 bg-white rounded-xl shadow-lg space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6 mb-2 w-96 border border-green-400 opacity-75 flex'
      : 'flex flex-wrap py-8 px-8 bg-white rounded-xl shadow-lg space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6 mb-2 w-96 border border-red-400 opacity-75 flex'
})

</script>