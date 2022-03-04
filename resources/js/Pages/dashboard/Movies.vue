<script setup>
import { defineProps } from 'vue'
import { Head } from '@inertiajs/inertia-vue3'
import MainLayout from '@/Layouts/Main.vue'

const title = 'Peliculas'

const props = defineProps({
  //movies: Array
})

const movies = [
  {
    id: 0,
    title: 'Spiderman Sin camino a casa',
    poster_url: 'https://www.themoviedb.org/t/p/w600_and_h900_bestv2/miZFgV81xG324rpUknQX8dtXuBl.jpg',
    synopsis: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo dignissimos voluptates ipsa nisi quasi, iure praesentium commodi omnis minima minus. Unde quas vero nam aliquid officia temporibus explicabo modi dolorum!',
    trailer_url: 'https://www.youtube.com/watch?v=r6t0czGbuGI',
    available: 1,
    movie_length: 140
  },
  {
    id: 1,
    title: 'The Batman',
    poster_url: 'https://www.themoviedb.org/t/p/w600_and_h900_bestv2/pOaKyhMwALpCTg07eQQu0SQCbL9.jpg',
    synopsis: 'Cuando un asesino se dirige a la élite de Gotham con una serie de maquinaciones sádicas, un rastro de pistas crípticas envía Batman a una investigación en los bajos fondos. A medida que las pruebas comienzan a acercarse a su casa y se hace evidente la magnitud de los planes del autor, Batman debe forjar nuevas relaciones, desenmascarar al culpable y hacer justicia al abuso de poder y la corrupción que durante mucho tiempo han asolado Gotham City.',
    trailer_url: 'https://youtu.be/L6DEcPaNdLs',
    available: 1,
    movie_length: 160
  }
]

</script>

<template>
  <Head :title="title" />
  <MainLayout>
    <section class="py-12">
      <div class="p-5">
        <h1 class="text-2xl pb-5">Peliculas</h1>
      </div>
      <div class="overflow-x-auto">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    scope="col"
                  >Titulo</th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    scope="col"
                  >Synopsis</th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    scope="col"
                  >Estado</th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    scope="col"
                  >Acción</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr
                  :key="movie.id"
                  v-for="movie in movies"
                >
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <img
                          :src="movie.poster_url"
                          alt
                          class="h-10 w-10 rounded-full"
                        />
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">{{ movie.title }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">{{ movie.synopsis }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                      v-if="movie.available == 1"
                    >Disponible</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a
                      class="text-indigo-600 hover:text-indigo-900"
                      href="#"
                    >Edit</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </MainLayout>
</template>
