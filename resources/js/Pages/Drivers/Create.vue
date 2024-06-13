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
                    Cadastrar novo Motorista
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
                    >Modelo carro</label
                    >
                    <input
                        v-model="form.car_brand"
                        type="email"
                        id="email"
                        autocomplete="email"
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
                        for="email"
                        class="block text-sm font-medium text-gray-700"
                    >Chave Pix</label
                    >
                    <input
                        v-model="form.pix"
                        type="email"
                        id="email"
                        autocomplete="email"
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
                        for="email"
                        class="block text-sm font-medium text-gray-700"
                    >Valor personalizado da corrida</label
                    >
                    <input
                        v-model="form.run_price"
                        type="text"
                        id="email"
                        autocomplete="email"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.run_price,}"
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
                        id="role_id"
                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300' : form.errors.role_id,}"
                    >
                      <option value="">
                        Selecione um tipo de valor
                      </option>
                      <option value="percentage">% Porcentagem</option>
                      <option value="cash">R$ Dinheiro</option>
                    </select>
                    <InputError
                        class="mt-2"
                        :message="form.errors.role_id"
                    />
                  </div>

                  <div class="col-span-4 sm:col-span-3">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Foto motorista</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
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
import DriversStatusRun from "@/Components/DriversStatusRun.vue";

defineProps({
  roles: {
    type: Object,
  },
});

let roles = ref({});

const form = useForm({
  name: "",
  email: "",
  car_brand: "",
  pix: "",
  run_price: "",
  online: "",
  active: ""
});

watch(
    () => form.role_id,
    (newValue) => {
      getRoles(newValue);
    }
);

const getRoles = (class_id) => {
  axios.get("/api/roles").then((response) => {
    console.log(response.data)
    roles.value = response.data;
  });

  console.log(roles.value)
};

const submit = () => {
  form.post(route("drivers.store"), {
    preserveScroll: true,
  });
};
</script>