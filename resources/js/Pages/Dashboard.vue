<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <DriversStatusRun />
        </template>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
          <div class="relative text-sm text-gray-800 col-span-3">
            <div
                class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500"
            >
              <MagnifyingGlass />
            </div>

            <input
                type="text"
                v-model="searchTerm"
                placeholder="Buscar motorista..."
                id="search"
                class="block w-1/4 rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            />

          </div>
          <div class="mt-2">
            <DangerButton>Registrar corrida perdida</DangerButton>
          </div>

          <ModalNewRun />
        </div>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">{{ driversOnline }}</h2>
              <div class="grid grid-cols-3 gap-3">
                <div v-if="drivers_available.data.length > 0" v-for="driver_available in drivers_available.data" :key="driver_available.id" class="">
                  <DriverCardOnline
                      :name="driver_available.user.name"
                      :online="driver_available.online"
                      :in_run="driver_available.in_run"
                      :avatar="driver_available.user.avatar"
                      :time_last_run="driver_available.runs.length > 0 ? driver_available.runs[0].ended_at : null"
                      :stars="useCalculateStarRate(driver_available.runs.length, driver_available.likes, driver_available.dislikes)"
                      :total_runs="driver_available.runs.length"
                      :likes="driver_available.likes"
                      :dislikes="driver_available.dislikes"
                  />
                </div>
                <div v-else class="flex justify-center text-center">
                  <h3 class="text-gray-500">No momento, todos os motoristas estão offline.</h3>
                </div>
              </div>
            </div>
        </div>
        <hr>
        <div class="py-6 pb-20">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">{{ driversOffline }}</h2>
            <div class="grid grid-cols-3 gap-3">
              <div v-if="drivers_offline.data.length > 0" v-for="drivers_offline in drivers_offline.data" :key="drivers_offline.id">
                <DriverCardOffline
                    :name="drivers_offline.user.name"
                    :online="drivers_offline.online"
                    :in_run="drivers_offline.in_run"
                    :avatar="drivers_offline.user.avatar"
                    :stars="useCalculateStarRate(drivers_offline.runs.length, drivers_offline.likes, drivers_offline.dislikes)"
                    :total_runs="drivers_offline.runs.length"
                    :likes="drivers_offline.likes"
                    :dislikes="drivers_offline.dislikes"
                />
              </div>
              <div v-else class="flex justify-center text-center">
                <h3 class="text-gray-500">No momento, todos os motoristas estão online.</h3>
              </div>
            </div>
          </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import {Head} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import DriversStatusRun from "@/Components/DriversStatusRun.vue";
import DriverCardOffline from "@/Components/DriverCardOffline.vue";
import DriverCardOnline from "@/Components/DriverCardOnline.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {computed} from "vue";
import ModalNewRun from "@/Components/ModalNewRun.vue";
import {useCalculateStarRate} from "@/Components/Composable/useCalculateStarRate.js";


const props = defineProps({
  drivers_available: {
    type: Object,
  },
  drivers_offline: {
    type: Object,
  },
});

const driversOnline = computed(() => {
  const total_drivers_available = props.drivers_available.data.length

  console.log(total_drivers_available)

  if (total_drivers_available === 1) {
    return `${total_drivers_available} motorista online`
  }

  return `${total_drivers_available} motoristas online`
})

const driversOffline = computed(() => {
  const total_drivers_offline = props.drivers_offline.data.length

  console.log(total_drivers_offline)

  if (total_drivers_offline === 1) {
    return `${total_drivers_offline} motorista offline`
  }

  return `${total_drivers_offline} motoristas offline`
})

</script>