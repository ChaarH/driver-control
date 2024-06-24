<template>
  <Combobox v-model:selected="selectedDriver">
      <div class="relative mt-1">
        <div
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        >
          <ComboboxInput
              type="driver_id"
              class="w-full border-none py-1 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
              :displayValue="(driver) => driver.user"
              @change="query = $event.target.value"
          />
          <ComboboxButton
              class="absolute inset-y-0 right-0 flex items-center pr-2"
          >
            <ChevronUpDownIcon
                class="h-5 w-5 text-gray-400"
                aria-hidden="true"
            />
          </ComboboxButton>
        </div>
        <TransitionRoot
            leave="transition ease-in duration-100"
            leaveFrom="opacity-100"
            leaveTo="opacity-0"
            @after-leave="query = ''"
        >
          <ComboboxOptions
              class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
          >
            <div
                v-if="filteredDriver.length === 0 && query !== ''"
                class="relative cursor-default select-none px-4 py-2 text-gray-700"
            >
              Nenhum motorista disponível no momento
            </div>

            <ComboboxOption
                v-for="driver in filteredDriver"
                as="template"
                :key="driver.id"
                :value="driver"
                v-slot="{ selected, active }"
            >
              <li
                  class="relative cursor-default select-none py-2 pl-10 pr-4"
                  :class="{
                  'bg-blue-600 text-white': active,
                  'text-gray-900': !active,
                }"
              >
                <span
                    class="block truncate"
                    :class="{ 'font-medium': selected, 'font-normal': !selected }"
                >
                  {{ driver.name }}
                </span>
                <span
                    v-if="selected"
                    class="absolute inset-y-0 left-0 flex items-center pl-3"
                    :class="{ 'text-white': active, 'text-teal-600': !active }"
                >
                  <CheckIcon class="h-5 w-5" aria-hidden="true" />
                </span>
              </li>
            </ComboboxOption>
          </ComboboxOptions>
        </TransitionRoot>
      </div>
    </Combobox>
</template>

<script setup>
import { ref, computed } from 'vue'
import {
  Combobox,
  ComboboxInput,
  ComboboxOptions,
  ComboboxOption,
  ComboboxButton,
  TransitionRoot,
} from '@headlessui/vue'
import ChevronUpDownIcon from "@/Components/Icons/ChevronUpDownIcon.vue";
import CheckIcon from "@/Components/Icons/CheckIcon.vue";

const props = defineProps({
  drivers: Object
});

const selectedDriver = ref(props.drivers[0])

const query = ref()

const filteredDriver = computed(() =>
    query.value === ''
        ? props.drivers
        : props.drivers.filter((driver) => {
          return driver.user.name
              .toLowerCase()
              .replace(/\s+/g, '')
              .includes(query.value.toLowerCase().replace(/\s+/g, ''))
        })
)
</script>