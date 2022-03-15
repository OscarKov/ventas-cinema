<script setup>
import MainLayout from '@/Layouts/Main.vue'
import { Head, Link, usePage } from '@inertiajs/inertia-vue3'

const title = 'Panel de Usuario'

const user = usePage().props.value.auth.user

</script>

<template>
  <Head :title="title" />

  <MainLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <h2 class="text-lg">Que deseas hacer hoy {{ user.first_name }}?</h2>
          <div class="p-6 bg-white border-b border-gray-200">
            <ul>
              <li>
                <Link
                  :href="route('dashboard.movies')"
                  class="text-indigo-800"
                >Administrar Películas</Link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
