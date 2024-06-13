<template>
  <div class="max-w-2xl mx-4 sm:max-w-sm md:max-w-sm lg:max-w-sm xl:max-w-sm sm:mx-auto md:mx-auto lg:mx-auto xl:mx-auto mt-16 bg-white shadow-xl rounded-lg text-gray-900">
    <div class="rounded-t-lg h-32 overflow-hidden">
      <img class="object-cover object-top w-full" src='https://images.unsplash.com/photo-1549880338-65ddcdfd017b?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt='Mountain'>
    </div>
    <div class="mx-auto w-32 h-32 relative -mt-16 border-4 border-white rounded-full overflow-hidden">
      <img class="object-cover object-center h-32" :src="props.avatar" alt='Woman looking front'>
    </div>
    <div class="text-center mt-2">
      <h2 class="font-semibold">{{ props.name }}</h2>
      <p class="text-gray-500">Freelance Web Designer</p>
    </div>
    <ul class="py-4 mt-2 text-gray-700 flex items-center justify-around">
      <li class="flex flex-col items-center justify-around">
        <StarsIcon />
        <div>2k</div>
      </li>
      <li class="flex flex-col items-center justify-around">
        <MenuDriverIcon />
        <div>2k</div>
      </li>
      <li class="flex flex-col items-center justify-between">
        <ThumbsUpIcon />
        <div>10k</div>
      </li>
      <li class="flex flex-col items-center justify-around">
        <ThumbsDownIcon />
        <div>15</div>
      </li>
    </ul>
    <div class="p-4 border-t mx-8 mt-2">
      <button class="w-1/2 block mx-auto rounded-md bg-indigo-600 hover:bg-indigo-700 hover:shadow-lg font-semibold text-white px-6 py-2">Selecionar</button>
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

</script>