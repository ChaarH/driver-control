<template>
  <Head title="Users" />

  <AuthenticatedLayout>
    <template #header>
      <DriversStatusTrip />
    </template>
    <div class="bg-gray-100 py-10">
      <div class="mx-auto max-w-7xl">
        <div class="px-4 sm:px-6 lg:px-8">
          <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
              <h1 class="text-xl font-semibold text-gray-900">
                Usuários registrados
              </h1>
            </div>

            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
              <Link
                  :href="route('users.create')"
                  class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
              >
                Novo usuário
              </Link>
            </div>
          </div>

          <div class="flex flex-col justify-between sm:flex-row mt-6">
            <div class="relative text-sm text-gray-800 col-span-3">
              <div
                  class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500"
              >
                <MagnifyingGlass />
              </div>

              <input
                  type="text"
                  v-model="searchTerm"
                  placeholder="Buscar usuário..."
                  id="search"
                  class="block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
              />
            </div>
          </div>

          <div class="border-b border-gray-300 dark:border-gray-300">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
              <li class="me-2">
                <a href="#" :class="classActiveTab('active')" @click="setActiveTab('active')">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                  </svg>Usuários ativos
                </a>
              </li>
              <li class="me-2">
                <a href="#" :class="classActiveTab('inactive')" @click="setActiveTab('inactive')" aria-current="page">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="m5.965 4.904 9.131 9.131a6.5 6.5 0 0 0-9.131-9.131Zm8.07 10.192L4.904 5.965a6.5 6.5 0 0 0 9.131 9.131ZM4.343 4.343a8 8 0 1 1 11.314 11.314A8 8 0 0 1 4.343 4.343Z" clip-rule="evenodd" />
                  </svg>Usuários inativos
                </a>
              </li>
            </ul>
          </div>

          <div v-if="activeTab === 'active'" class="mt-8 flex flex-col">
            <div
                class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8"
            >
              <div
                  class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
              >
                <div
                    class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative"
                >
                  <table
                      class="min-w-full divide-y divide-gray-300"
                  >
                    <thead class="bg-gray-50">
                    <tr>
                      <th
                          scope="col"
                          class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                      >
                        ID
                      </th>
                      <th
                          scope="col"
                          class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                      >
                        Nome
                      </th>
                      <th
                          scope="col"
                          class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                      >
                        Status
                      </th>
                      <th
                          scope="col"
                          class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                      >
                        Perfil
                      </th>
                      <th
                          scope="col"
                          class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                      >
                        Criado em
                      </th>
                      <th
                          scope="col"
                          class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                      >
                        Ação
                      </th>
                    </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-gray-200 bg-white"
                    >
                    <tr v-if="active_users.data.length > 0"
                        v-for="user in active_users.data"
                        :key="user.id"
                    >
                      <td
                          class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                      >
                        {{ user.id }}
                      </td>
                      <td
                          class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                      >
                        <div class="flex">
                          <img class="w-7 h-7 rounded-full" :src="user.avatar" alt="Rounded avatar">
                          <span class="pl-2 pt-1">
                            {{ user.name }}
                          </span>
                        </div>
                        <span class="pl-9 text-sm text-gray-400">{{ user.email }}</span>
                      </td>
                      <td
                          class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                      >
                        <BadgeBoolean :text="user.deleted_at === null ? 'Ativo' : 'Inativo'" :value="user.deleted_at === null ? true : false" />
                      </td>
                      <td
                          class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                      >
                        <BadgeRole :role="user.role_id" />
                      </td>
                      <td
                          class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                      >
                        {{ user.created_at }}
                      </td>

                      <td
                          class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                      >
                        <Link
                            :href="
                            route('users.edit', user.id)"
                            class="text-indigo-600 hover:text-indigo-900"
                        >
                          Editar
                        </Link>
                        <button
                            @click="deleteUser(user.id)"
                            class="ml-2 text-indigo-600 hover:text-indigo-900"
                        >
                          Desativar
                        </button>
                      </td>
                    </tr>
                    <tr v-else>
                      <td class="py-4 text-center text-gray-600" colspan="6">Nenhum registro encontrado</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <Pagination
                    :data="active_users"
                    :pageNumberUpdated="pageNumberUpdated"
                />
              </div>
            </div>
          </div>

          <div v-else class="mt-8 flex flex-col">
            <div
                class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8"
            >
              <div
                  class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
              >
                <div
                    class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative"
                >
                  <table
                      class="min-w-full divide-y divide-gray-300"
                  >
                    <thead class="bg-gray-50">
                    <tr>
                      <th
                          scope="col"
                          class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                      >
                        ID
                      </th>
                      <th
                          scope="col"
                          class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                      >
                        Nome
                      </th>
                      <th
                          scope="col"
                          class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                      >
                        Status
                      </th>
                      <th
                          scope="col"
                          class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                      >
                        Perfil
                      </th>
                      <th
                          scope="col"
                          class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                      >
                        Criado em
                      </th>
                      <th
                          scope="col"
                          class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                      >
                        Ação
                      </th>
                    </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-gray-200 bg-white"
                    >
                    <tr
                        v-if="inactive_users.data.length > 0" v-for="user in inactive_users.data"
                        :key="user.id"
                    >
                      <td
                          class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                      >
                        {{ user.id }}
                      </td>
                      <td
                          class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                      >
                        <div class="flex">
                          <img class="w-7 h-7 rounded-full" :src="user.avatar" alt="Rounded avatar">
                          <span class="pl-2 pt-1">
                            {{ user.name }}
                          </span>
                        </div>
                        <span class="pl-9 text-sm text-gray-400">{{ user.email }}</span>
                      </td>
                      <td
                          class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                      >
                        <BadgeBoolean :text="user.deleted_at === null ? 'Ativo' : 'Inativo'" :value="user.deleted_at === null ? true : false" />
                      </td>
                      <td
                          class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                      >
                        <BadgeRole :role="user.role_id" />
                      </td>
                      <td
                          class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                      >
                        {{ user.created_at }}
                      </td>

                      <td
                          class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                      >
                        <Link
                            :href="
                            route('users.edit', user.id)"
                            class="text-indigo-600 hover:text-indigo-900"
                        >
                          Editar
                        </Link>
                        <button
                            @click="deleteUser(user.id)"
                            class="ml-2 text-indigo-600 hover:text-indigo-900"
                        >
                          Reativar
                        </button>
                      </td>
                    </tr>
                    <tr v-else>
                      <td class="py-4 text-center text-gray-600" colspan="6">Nenhum registro encontrado</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <Pagination
                    :data="inactive_users"
                    :pageNumberUpdated="pageNumberUpdated"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import Pagination from "@/Components/Pagination.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { ref, watch, computed } from "vue";
import BadgeRole from "@/Components/BadgeRole.vue";
import BadgeBoolean from "@/Components/BadgeBoolean.vue";
import DriversStatusTrip from "@/Components/DriversStatusTrip.vue";

defineProps({
  active_users: {
    type: Object,
  },
  inactive_users: {
    type: Object
  }
});

let activeTab = ref('active');

function setActiveTab(param_tab) {
  activeTab.value = param_tab
}

function classActiveTab(param_tab) {
  return activeTab.value === param_tab
    ? 'inline-flex items-center justify-center p-4 rounded-t-lg border-b-2 hover:border-blue-300 dark:text-blue-500 dark:border-blue-500 border-blue-300 group'
    : 'inline-flex items-center justify-center p-4 rounded-t-lg hover:opacity-75 hover:border-gray-300 dark:text-gray-500 dark:border-gray-500 border-gray-300 group'
}

let pageNumber = ref(1),
    searchTerm = ref(usePage().props.search ?? "");

const pageNumberUpdated = (link) => {
  pageNumber.value = link.url.split("=")[1];
};



let usersUrl = computed(() => {
  const url = new URL(route("users.index"));

  url.searchParams.set("page", pageNumber.value);

  if (searchTerm.value) {
    url.searchParams.set("search", searchTerm.value);
  }

  return url;
});

watch(
    () => usersUrl.value,
    (newValue) => {
      router.visit(newValue, {
        replace: true,
        preserveState: true,
        preserveScroll: true,
      });
    }
);

const deleteForm = useForm({});

const deleteUser = (id) => {
  if (confirm("Tem certeza de que quer deletar este usuário?")) {
    deleteForm.delete(route("users.destroy", id), {
      preserveScroll: true,
    });
  }
};
</script>