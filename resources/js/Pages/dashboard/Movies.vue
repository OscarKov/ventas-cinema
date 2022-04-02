<script setup>
import { ref, defineProps } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { Link, Head } from '@inertiajs/inertia-vue3'

import MainLayout from '@/Layouts/Main.vue'
import BreezeButton from '@/Components/Button.vue'


const title = 'Peliculas'

const props = defineProps({
  movies: Array
})

const isAvailable = (movie) => {
  return movie.available == 1
}

const deleteMovie = (movieId) => {
  Inertia.delete(route('movie.delete'), {
    data: {
      movie_id: movieId
    }
  })
}

</script>

<template>
  <Head :title="title" />
  <MainLayout>
    <section class="py-12">
      <div class="p-5">
        <h1 class="text-2xl pb-5">Peliculas</h1>
        <div>
          <Link :href=" route('dashboard.movies') + '/add' ">
            <BreezeButton class="ml-4">Agregar Película</BreezeButton>
          </Link>
        </div>
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
                <tr v-if="movies.length == 0">
                  <p class="text-lg text-center">Aún no hay peliculas.</p>
                </tr>
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
                    <span
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-green-800"
                      v-else
                    >No Disponible</span>
                  </td>
                  <td class="px-2 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div>
                      <Link
                        :href="`${route('dashboard.movies')}/edit/${movie.id}`"
                        class="text-indigo-600 hover:text-indigo-900"
                      >Editar</Link>|
                      <a
                        @click.capture="deleteMovie(movie.id)"
                        class="text-red-600 hover:text-indigo-900"
                      >Eliminar</a>
                    </div>
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
