<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
  layout: BreezeGuestLayout,

  components: {
    BreezeButton,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors,
    Head,
    Link,
  },

  data () {
    return {
      title: 'Registro',
      form: this.$inertia.form({
        first_name: '',
        last_name: '',
        phone: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms: false,
      })
    }
  },

  methods: {
    submit () {
      this.form.post(this.route('register'), {
        onFinish: () => this.form.reset('password', 'password_confirmation'),
      })
    }
  }
}
</script>

<template>
  <Head :title="title" />
  <main class="max-w-full">
    <section class="p-4">
      <div class="sm:w-3/5 lg:w-2/5 m-auto">
        <h1 class="text-2xl mb-4">{{ title }}</h1>
        <BreezeValidationErrors class="mb-4" />
        <form @submit.prevent="submit">
          <div>
            <BreezeLabel
              for="first_name"
              value="Nombres"
            />
            <BreezeInput
              autocomplete="first_name"
              autofocus
              class="mt-1 block w-full"
              id="first_name"
              required
              type="text"
              v-model="form.first_name"
            />
          </div>
          <div class="mt-4">
            <BreezeLabel
              for="last_name"
              value="Apellidos"
            />
            <BreezeInput
              autocomplete="last_name"
              autofocus
              class="mt-1 block w-full"
              id="last_name"
              required
              type="text"
              v-model="form.last_name"
            />
          </div>
          <div class="mt-4">
            <BreezeLabel
              for="email"
              value="Correo"
            />
            <BreezeInput
              autocomplete="username"
              class="mt-1 block w-full"
              id="email"
              required
              type="email"
              v-model="form.email"
            />
          </div>
          <div class="mt-4">
            <BreezeLabel
              for="phone"
              value="Telefono / Celular"
            />
            <BreezeInput
              class="mt-1 block w-full"
              id="phone"
              type="text"
              v-model="form.phone"
            />
          </div>
          <div class="mt-4">
            <BreezeLabel
              for="password"
              value="Contraseña"
            />
            <BreezeInput
              autocomplete="new-password"
              class="mt-1 block w-full"
              id="password"
              required
              type="password"
              v-model="form.password"
            />
          </div>

          <div class="mt-4">
            <BreezeLabel
              for="password_confirmation"
              value="Confirmar Contraseña"
            />
            <BreezeInput
              autocomplete="new-password"
              class="mt-1 block w-full"
              id="password_confirmation"
              required
              type="password"
              v-model="form.password_confirmation"
            />
          </div>

          <div class="flex items-center justify-end mt-4">
            <Link
              :href="route('login')"
              class="underline text-sm text-gray-600 hover:text-gray-900"
            >Ya estas registrado?</Link>

            <BreezeButton
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              class="ml-4"
            >Registrar</BreezeButton>
          </div>
        </form>
      </div>
    </section>
  </main>
</template>
