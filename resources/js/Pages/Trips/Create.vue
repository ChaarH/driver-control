<template>
  <Head title="Novo atendimento" />

  <AuthenticatedLayout>
    <template #header>
      <DriversStatusTrip />
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
                    Cadastrar novo atendimento
                  </h3>
                </div>

                <div class="grid grid-cols-6 gap-6">

                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="driver_id"
                        class="block text-sm font-medium text-gray-700"
                    >Motoristas disponíveis *</label
                    >
                    <ComboBox
                        v-model="form.driver_id"
                        id="driver_id"
                        :drivers="drivers.data"
                    />
                  </div>

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
                        for="address_from"
                        class="block text-sm font-medium text-gray-700"
                    >Endereço de origem</label
                    >
                    <input
                        v-model="form.address_from"
                        type="address_from"
                        id="address_from"
                        autocomplete="address_from"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.address_from,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.address_from"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="address_to"
                        class="block text-sm font-medium text-gray-700"
                    >Endereço de destino</label
                    >
                    <input
                        v-model="form.address_to"
                        type="address_to"
                        id="address_to"
                        autocomplete="address_to"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.address_to,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.address_to"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="district_from"
                        class="block text-sm font-medium text-gray-700"
                    >Bairro de origem</label
                    >
                    <input
                        v-model="form.district_from"
                        type="district_from"
                        id="district_from"
                        autocomplete="district_from"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.district_from,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.district_from"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="district_to"
                        class="block text-sm font-medium text-gray-700"
                    >Bairro de destino</label
                    >
                    <input
                        v-model="form.district_to"
                        type="district_to"
                        id="district_to"
                        autocomplete="district_to"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.district_to,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.district_to"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="city_from"
                        class="block text-sm font-medium text-gray-700"
                    >Cidade de origem</label
                    >
                    <input
                        v-model="form.city_from"
                        type="city_from"
                        id="city_from"
                        autocomplete="city_from"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.city_from,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.city_from"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="city_to"
                        class="block text-sm font-medium text-gray-700"
                    >Cidade de destino</label
                    >
                    <input
                        v-model="form.city_to"
                        type="city_to"
                        id="city_to"
                        autocomplete="city_to"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.city_to,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.city_to"
                    />
                  </div>
                </div>
              </div>
              <div
                  class="px-4 py-3 bg-gray-50 text-right sm:px-6"
              >
                <Link
                    :href="route('users.index')"
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
import { Head, Link, useForm } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import axios from "axios";
import InputError from "@/Components/InputError.vue";
import DriversStatusTrip from "@/Components/DriversStatusTrip.vue";
import ComboBoxView from "@/Components/ComboBoxView.vue";
import ComboBox from "@/Components/ComboBox.vue";

defineProps({
  reasosn_for_withdrawal: Object,
  drivers: Object
});

const form = useForm({
  driver_id: "",
  address_from: "",
  address_to: "",
  city_from: "",
  city_to: "",
  district_from: "",
  district_to: "",
});

const submit = () => {
  form.post(route("trips.store"), {
    preserveScroll: true,
  });
};
</script>