<template>
  <div class="py-8 px-8 bg-gray-200 rounded-xl shadow-lg space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6 mb-2 w-96 border border-gray-400 opacity-75">
    <div class="">
      <img class="block mx-auto h-18 rounded-full sm:mx-0 sm:shrink-0" :src="props.avatar" :alt="formattedDriverName" />
    </div>
    <div class="text-center space-y-2 sm:text-left w-3/4">
      <div class="space-y-0.5">
        <p class="text-lg text-black font-semibold">
          {{ formattedDriverName }}
        </p>
        <div class="inline-flex">
        <span class="relative flex h-3 w-3">
          <span class="absolute inline-flex h-full w-full rounded-full bg-gray-400 opacity-75"></span>
          <span class="relative inline-flex rounded-full h-3 w-3 bg-gray-400"></span>
        </span>
        </div>
        <span class="font-light text-xs pl-2">Offline</span>
      </div>
      <div class="w-full flex">
        <div class="pt-1 w-2/4">
          <button class="inline-flex items-center justify-center text-xs rounded-md border border-transparent bg-gray-400 px-3 py-1 font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:w-auto">Detalhes</button>
        </div>
        <div class="flex w-2/4 justify-end text-xs">
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
</template>

<script setup>
import {computed, ref} from 'vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ThumbsUpIcon from "@/Components/Icons/ThumbsUpIcon.vue";
import ThumbsDownIcon from "@/Components/Icons/ThumbsDownIcon.vue";
import MenuDriverIcon from "@/Components/Icons/MenuIcons/MenuDriverIcon.vue";
import StarsIcon from "@/Components/Icons/StarsIcon.vue";
import TruckIcon from "@/Components/Icons/TruckIcon.vue";

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

const formattedDriverName = computed(() => {
  let split_name = props.name.split(' ')

  return split_name.length > 1
      ? `${split_name[0]} ${split_name[1]}`
      : split_name[0]
})

</script>