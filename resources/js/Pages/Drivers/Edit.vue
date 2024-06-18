<template>
  <Head title="Motoristas" />

  <AuthenticatedLayout>
    <template #header>
      <DriversStatusRun />
    </template>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
          <form @submit.prevent="submit">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
              <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <div>
                  <h3
                      class="text-lg leading-6 font-medium text-gray-900"
                  >
                    Detalhes do motorista
                  </h3>
                </div>

                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                    >Nome</label
                    >
                    <input
                        v-model="form.name"
                        type="text"
                        id="name"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.name,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.name"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700"
                    >E-mail</label
                    >
                    <input
                        v-model="form.email"
                        type="email"
                        id="email"
                        autocomplete="email"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.email,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.email"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="car_brand"
                        class="block text-sm font-medium text-gray-700"
                    >Modelo carro</label
                    >
                    <input
                        v-model="form.car_brand"
                        type="text"
                        id="car_brand"
                        autocomplete="car_brand"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.car_brand,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.car_brand"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="pix"
                        class="block text-sm font-medium text-gray-700"
                    >Chave Pix</label
                    >
                    <input
                        v-model="form.pix"
                        type="text"
                        id="pix"
                        autocomplete="pix"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.pix,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.pix"
                    />
                  </div>

                  <div class="col-span-4 sm:col-span-3">
                    <label
                        for="run_price"
                        class="block text-sm font-medium text-gray-700"
                    >Valor personalizado da corrida</label
                    >
                    <input
                        v-model="form.run_price"
                        type="text"
                        id="run_price"
                        autocomplete="run_price"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.run_price}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.run_price"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="class_id"
                        class="block text-sm font-medium text-gray-700"
                    >Tipo de valor</label
                    >
                    <select
                        v-model="form.type_price"
                        id="type_price"
                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.type_price}"
                    >
                      <option value="">Selecione um tipo de valor</option>
                      <option value="percentage">% Porcentagem</option>
                      <option value="cash">R$ Dinheiro</option>
                    </select>
                    <InputError
                        class="mt-2"
                        :message="form.errors.role_id"
                    />
                  </div>

                  <div class="col-span-4 sm:col-span-3">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="avatar">Foto motorista</label>
                    <input @change="onFileSelected" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md py-1 pl-1 cursor-pointer dark:text-gray-400 focus:outline-none" name="avatar" id="avatar" type="file">
                    <InputError
                        class="mt-2"
                        :message="form.errors.avatar"
                    />
                  </div>

                  <div class="col-span-4 sm:col-span-3 mt-8">
                    <div class="flex items-center mb-4">
                      <input id="country-option-1" type="radio" name="online" value="USA" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                      <label for="country-option-1" class="block ms-2 text-sm font-medium text-black">
                        Online
                      </label>
                    </div>
                  </div>

                  <div class="col-span-4 sm:col-span-3 mt-8">
                    <div class="flex items-center mb-4">
                      <input id="country-option-1" type="radio" name="online" value="USA" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                      <label for="country-option-1" class="block ms-2 text-sm font-medium text-black">
                        Motorista ativo
                      </label>
                    </div>
                  </div>

                </div>

              </div>
              <div
                  class="px-4 py-3 bg-gray-50 text-right sm:px-6"
              >
                <Link
                    :href="route('drivers.index')"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4"
                >
                  Cancelar
                </Link>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                  Salvar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link, useForm, usePage} from "@inertiajs/vue3";
import { watch, ref } from "vue";
import axios from "axios";
import InputError from "@/Components/InputError.vue";
import DriversStatusRun from "@/Components/DriversStatusRun.vue";

defineProps({
  driver: {
    type: Object,
  },
});

const driver = usePage().props.driver;

const form = useForm({
  name: driver.data.user.name,
  email: driver.data.user.email,
  car_brand: driver.data.car_brand,
  avatar: driver.data.name,
  pix: driver.data.pix,
  run_price: driver.data.run_price,
  type_price: driver.type_price,
  online: driver.data.online,
  active: ""
});

let fileSelected = ref(null)

function onFileSelected(event) {
  fileSelected.value = event.target.files[0]
  form.avatar = fileSelected.value
}

const submit = () => {
  form.post(route("drivers.store"), {
    preserveScroll: true,
  });
};
</script>