<script setup>
import { ref, defineProps, onMounted } from 'vue'
import { Link, Head, useForm } from '@inertiajs/inertia-vue3'

import MainLayout from '@/Layouts/Main.vue'
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'


const title = 'Editar Película'

const props = defineProps({
  movie: Object
})

const movieForm = useForm({
  title: '',
  synopsis: '',
  poster_url: '',
  trailer_url: '',
  available: true,
  movie_length: 0
})

const success = ref(false)

const submit = () => {
  movieForm.post(`${route('dashboard.movies')}/edit/${props.movie.id}`, {
    onSuccess: () => {
      success.value = true
    }
  })
}

onMounted(() => {
  movieForm.title = props.movie.title
  movieForm.synopsis = props.movie.synopsis
  movieForm.poster_url = props.movie.poster_url
  movieForm.trailer_url = props.movie.trailer_url
  movieForm.available = props.movie.available == 1
  movieForm.movie_length = props.movie.movie_length
})

</script>

<template>
  <Head :title="title" />
  <MainLayout>
    <section class="py-12">
      <div class="p-5">
        <h1 class="text-2xl pb-5">{{ title }}</h1>
      </div>
      <div class="overflow-x-auto">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <div class="w-4/5 m-auto">
              <BreezeValidationErrors class="mb-4" />
              <div
                class="max-w-xl bg-green-600"
                v-if="success"
              >
                <p class="text-white">Pelicula guardada</p>
              </div>
              <div class="mb-4 font-medium text-sm text-green-600"></div>

              <form @submit.prevent="submit">
                <div>
                  <BreezeLabel
                    for="title"
                    value="Titulo"
                  />
                  <BreezeInput
                    autocomplete="title"
                    autofocus
                    class="mt-1 block w-full"
                    id="title"
                    required
                    type="text"
                    v-model="movieForm.title"
                  />
                </div>
                <div>
                  <BreezeLabel
                    for="synopsis"
                    value="Synopsis"
                  />
                  <textarea
                    class="mt-1 block w-full"
                    id="synopsis"
                    required
                    type="textarea"
                    v-model="movieForm.synopsis"
                  ></textarea>
                </div>
                <div>
                  <BreezeLabel
                    for="poster_url"
                    value="URL del poster"
                  />
                  <BreezeInput
                    autocomplete="poster_url"
                    class="mt-1 block w-full"
                    id="poster_url"
                    required
                    type="text"
                    v-model="movieForm.poster_url"
                  />
                </div>
                <div>
                  <BreezeLabel
                    for="trailer_url"
                    value="URL del trailer"
                  />
                  <BreezeInput
                    autocomplete="trailer_url"
                    class="mt-1 block w-full"
                    id="trailer_url"
                    required
                    type="text"
                    v-model="movieForm.trailer_url"
                  />
                </div>
                <div>
                  <BreezeLabel
                    for="movie_length"
                    value="Duracion de la pelicula (Minutos)"
                  />
                  <BreezeInput
                    autocomplete="movie_length"
                    class="mt-1 block w-full"
                    id="movie_length"
                    required
                    type="number"
                    v-model="movieForm.movie_length"
                  />
                </div>
                <div class="block mt-4">
                  <label class="flex items-center">
                    <BreezeCheckbox
                      name="remember"
                      v-model:checked="movieForm.available"
                    />
                    <span class="ml-2 text-sm text-gray-600">Disponible</span>
                  </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                  <BreezeButton
                    :class="{ 'opacity-25': movieForm.processing }"
                    :disabled="movieForm.processing"
                    class="ml-4"
                  >Guardar</BreezeButton>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </MainLayout>
</template>
