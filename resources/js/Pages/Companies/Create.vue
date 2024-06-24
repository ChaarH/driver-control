<template>
  <Head title="Empresas" />

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
                    Cadastrar nova empresa
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
                        for="email"
                        class="block text-sm font-medium text-gray-700"
                    >Endereço</label
                    >
                    <input
                        v-model="form.address"
                        type="text"
                        id="address"
                        autocomplete="address"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.address,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.address"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700"
                    >Cidade</label
                    >
                    <input
                        v-model="form.city"
                        type="city"
                        id="city"
                        autocomplete="city"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.city,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.city"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="phone_1"
                        class="block text-sm font-medium text-gray-700"
                    >Telefone 1</label
                    >
                    <input
                        v-model="form.phone_1"
                        type="phone_1"
                        id="phone_1"
                        autocomplete="phone_1"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.phone_1,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.phone_1"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label
                        for="phone_1"
                        class="block text-sm font-medium text-gray-700"
                    >Telefone 2</label
                    >
                    <input
                        v-model="form.phone_2"
                        type="phone_2"
                        id="phone_2"
                        autocomplete="phone_2"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.phone_2,}"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.phone_2"
                    />
                  </div>

                </div>

              </div>
              <div
                  class="px-4 py-3 bg-gray-50 text-right sm:px-6"
              >
                <Link
                    :href="route('companies.index')"
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

const form = useForm({
  name: "",
  email: "",
});

const submit = () => {
  form.post(route("companies.store"), {
    preserveScroll: true,
  });
};
</script>