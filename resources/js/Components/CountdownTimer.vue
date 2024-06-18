<template>
  <div class="h-10 pt-2 text-2xl leading-10 text-black font-semibold text-center">
    <span class="text-sm font-light">{{ mountInRunText }}</span> {{ countdown }}
  </div>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";

const props = defineProps({
  initial_time: {
    type: String
  },
  in_run: {
    type: Boolean
  }
})

const countdown = ref()

onMounted(() => {
  idleTime()
  setInterval(idleTime, 1000)
})

const mountInRunText = computed(() => {
  return props.in_run
    ? 'Iniciado há'
    : 'Ocioso há'
})

function idleTime() {
  const now = new Date().getTime();

  const dateObject = new Date(props.initial_time);
  const convertInitialTime = dateObject.getTime();
  const distance = now - convertInitialTime

  const days = Math.floor(distance / (1000 * 60 * 60 * 24));
  const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((distance % (1000 * 60)) / 1000);

  countdown.value = `${hours}h ${minutes}m ${seconds}s`
}
</script>
