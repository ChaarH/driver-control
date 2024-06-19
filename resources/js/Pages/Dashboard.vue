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
            <DangerButton @click="confirmUserDeletion">Delete Account</DangerButton>

            <Modal :show="confirmingUserDeletion" @close="closeModal">
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-black">
                  Cadastrar corrida perdida
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Close modal</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5">
                <form class="space-y-4" action="#">
                  <div>
                    <label for="email" class="block mb-2 text-sm font-medium">Your email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required />
                  </div>
                  <div>
                    <label for="password" class="block mb-2 text-sm font-medium">Your password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                  </div>
                  <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cadastrar corrida perdida</button>
                </form>
              </div>
            </Modal>
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
import {computed, ref, nextTick} from "vue";
import ModalNewRun from "@/Components/ModalNewRun.vue";
import {useCalculateStarRate} from "@/Components/Composable/useCalculateStarRate.js";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import { useForm } from '@inertiajs/vue3';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
  password: '',
});

const confirmUserDeletion = () => {
  confirmingUserDeletion.value = true;

  // nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
  form.delete(route('profile.destroy'), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value.focus(),
    onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  confirmingUserDeletion.value = false;

  form.reset();
};

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

  if (total_drivers_available === 1) {
    return `${total_drivers_available} motorista online`
  }

  return `${total_drivers_available} motoristas online`
})

const driversOffline = computed(() => {
  const total_drivers_offline = props.drivers_offline.data.length

  if (total_drivers_offline === 1) {
    return `${total_drivers_offline} motorista offline`
  }

  return `${total_drivers_offline} motoristas offline`
})

</script>