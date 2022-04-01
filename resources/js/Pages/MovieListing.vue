<script setup>
import { ref, onUpdated } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { Head, Link, usePage } from '@inertiajs/inertia-vue3'
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogOverlay,
  DialogTitle,
} from '@headlessui/vue'
import MainLayout from '@/Layouts/Main.vue'
import ListingCarousel from '@/Components/Carousel.vue'
import PurchaseForm from '@/Components/PurchaseForm.vue'

onUpdated(() => {
  closeModal()
})

defineProps({
  movie: Object,
  shows: Array
})

const selectedShow = ref({})

const isOpen = ref(false)

function closeModal () {
  isOpen.value = false
}
function openModal () {
  isOpen.value = true
}

const parseDate = (date) => {
  return new Date(date).toLocaleDateString(
    'es-co', {
    weekday: "long",
    year: "numeric",
    month: "short",
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit"
  }
  );
}

const soldOut = (show) => {
  return show.room.max_quota == show.tickets_sold
}

const onPurchase = (show) => {
  if (!usePage().props.value.auth.user) {
    Inertia.visit(route('login'), {
      data: {
        redirect: window.location.pathname
      }
    })
  } else {
    selectedShow.value = show
    openModal()
  }
}

</script>

<template>
  <Head :title="'Horarios ' + movie.title" />
  <MainLayout>
    <section class="p-4">
      <div class="flex flex-wrap items-center justify-center mx-auto max-w-7xl">
        <div class="w-full md:w-1/2">
          <div class="flex flex-wrap">
            <div class="w-full">
              <img
                :src="movie.poster_url"
                alt="poster_url"
                class="poster_url md:max-w-xs mx-auto"
              />
            </div>
          </div>
        </div>
        <div class="w-full md:w-1/2">
          <div class="flex flex-wrap justify-center">
            <h1 class="w-full text-2xl font-bold">{{ movie.title }}</h1>
            <p class="w-full">{{ movie.synopsis }}</p>
            <div
              class="mt-6 w-full"
              v-if="shows.length > 0"
            >
              <h1 class="text-2xl font-bold">Horarios:</h1>
              <div
                :key="show.id"
                class="flex wrap justify-between bg-white overflow-hidden shadow-lg sm:rounded-lg p-4 my-2"
                v-for="show in shows"
              >
                <div>
                  <h2 class="text-xl">{{ show.room.description }}</h2>
                  <h2>{{ parseDate(show.starts_at) }}</h2>
                </div>
                <div>
                  <span
                    class="bg-red-700 text-white p-2 rounded-lg"
                    v-if="soldOut(show)"
                  >Lleno</span>
                  <button
                    @click="onPurchase(show)"
                    class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
                    v-else
                  >Comprar</button>
                </div>
              </div>
            </div>
            <div
              class="mt-6 w-full"
              v-else
            >
              <h2 class="font-bold">No hay horarios disponibles.</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <TransitionRoot
        :show="isOpen"
        appear
        as="template"
      >
        <Dialog
          @close="closeModal"
          as="div"
        >
          <DialogOverlay class="fixed inset-0 bg-black opacity-80" />
          <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="min-h-screen px-4 text-center">
              <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
              >
                <DialogOverlay class="fixed inset-0" />
              </TransitionChild>

              <span
                aria-hidden="true"
                class="inline-block h-screen align-middle"
              >&#8203;</span>

              <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0 scale-95"
                enter-to="opacity-100 scale-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100 scale-100"
                leave-to="opacity-0 scale-95"
              >
                <div
                  class="inline-block w-full max-w-6xl p-6 my-8 overflow-hidden align-middle transition-all transform bg-white shadow-xl rounded-2xl"
                >
                  <DialogTitle
                    as="h3"
                    class="text-lg font-medium leading-6 text-gray-900"
                  >Entradas {{ movie.title }}</DialogTitle>
                  <div class="mt-2 bg-slate-900 text-white">
                    <h3 class="text-md font-bold">Fecha y hora de la función:</h3>
                    <p>{{ parseDate(selectedShow.starts_at) }}</p>
                  </div>
                  <PurchaseForm :movieShow="selectedShow" />
                  <div class="mt-4">
                    <button
                      @click="closeModal"
                      class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-slate-600 border border-transparent rounded-md hover:bg-slate-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
                      type="button"
                    >Cerrar Dialogo</button>
                  </div>
                </div>
              </TransitionChild>
            </div>
          </div>
        </Dialog>
      </TransitionRoot>
    </section>
  </MainLayout>
</template>
