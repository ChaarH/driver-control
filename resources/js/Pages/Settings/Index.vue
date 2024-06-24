<template>
  <Head title="Motoristas" />

  <AuthenticatedLayout>
    <template #header>
      <DriversStatusTrip />
    </template>

    <div class="bg-gray-100 py-10">
      <div class="mx-auto max-w-7xl">
        <div class="px-4 sm:px-6 lg:px-8">
          <div class="sm:flex sm:items-center">
            <h2>Configurações em construção</h2>
          </div>
        </div>
      </div>
    </div>

  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DriversStatusTrip from "@/Components/DriversStatusTrip.vue";
import {Head} from "@inertiajs/vue3";
</script>