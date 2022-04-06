<script setup>
import { ref, defineProps } from 'vue'
import { Link, Head, useForm } from '@inertiajs/inertia-vue3'

import MainLayout from '@/Layouts/Main.vue'
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'

const title = 'Agregar Funcion'

defineProps({
  movies: Array,
  rooms: Array
})

const movieShowForm = useForm({
  starts_at: '',
  available: true,
  price: 0,
  movie_id: null,
  room_id: null
})

const success = ref(false)

const submit = () => {
  movieShowForm.post(route('shows.add'), {
    onSuccess: () => {
      success.value = true
    }
  })
}

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
                <div class="block mt-4">
                  <BreezeLabel
                    for="movie_id"
                    value="Pelicula"
                  />
                  <select
                    name="movie_id"
                    title="Pelicula"
                    v-model="movieShowForm.movie_id"
                  >
                    <option :value="null">Seleccione una pelicula</option>
                    <option
                      :key="movie.id"
                      :value="movie.id"
                      v-for="movie in movies"
                    >{{ movie.title }}</option>
                  </select>
                </div>
                <div class="block mt-4">
                  <BreezeLabel
                    for="room_id"
                    value="Sala"
                  />
                  <select
                    name="room_id"
                    title="Sala"
                    v-model="movieShowForm.room_id"
                  >
                    <option :value="null">Seleccione una sala</option>
                    <option
                      :key="room.id"
                      :value="room.id"
                      v-for="room in rooms"
                    >{{ room.description }}</option>
                  </select>
                </div>
                <div class="block mt-4">
                  <BreezeLabel
                    for="starts_at"
                    value="Fecha y hora de inicio"
                  />
                  <input
                    name="starts_at"
                    type="datetime-local"
                    v-model="movieShowForm.starts_at"
                  />
                </div>
                <div class="block mt-4">
                  <BreezeLabel
                    for="price"
                    value="Precio de la entrada"
                  />
                  <BreezeInput
                    autocomplete="price"
                    class="mt-1 block w-full"
                    id="price"
                    required
                    type="number"
                    v-model.number="movieShowForm.price"
                  />
                </div>
                <div class="block mt-4">
                  <label class="flex items-center">
                    <BreezeCheckbox
                      name="available"
                      v-model:checked="movieShowForm.available"
                    />
                    <span class="ml-2 text-sm text-gray-600">Disponible</span>
                  </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                  <BreezeButton
                    :class="{ 'opacity-25': movieShowForm.processing }"
                    :disabled="movieShowForm.processing"
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
