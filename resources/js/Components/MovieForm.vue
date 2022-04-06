<script setup>
import { ref } from 'vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'

import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'

const props = defineProps({
  action: String
})

const movieForm = useForm({
  title: '',
  synopsis: '',
  poster_url: '',
  trailer_url: '',
  available: false,
  movie_length: 0
})

const success = ref(false)

const submit = () => {
  movieForm.post(`${route('dashboard.movies')}/${props.action}`, {
    onSuccess: () => {
      success.value = true
    }
  })
}

</script>

<template>
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
          for="poster_url"
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
</template>
