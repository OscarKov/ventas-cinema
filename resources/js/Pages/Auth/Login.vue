<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
  layout: BreezeGuestLayout,

  components: {
    BreezeButton,
    BreezeCheckbox,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors,
    Head,
    Link,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data () {
    return {
      title: 'Inicio de Sesión',
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false
      })
    }
  },

  methods: {
    submit () {
      this.form.post(this.route('login'), {
        onFinish: () => this.form.reset('password'),
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

        <div
          class="mb-4 font-medium text-sm text-green-600"
          v-if="status"
        >{{ status }}</div>

        <form @submit.prevent="submit">
          <div>
            <BreezeLabel
              for="email"
              value="Correo"
            />
            <BreezeInput
              autocomplete="username"
              autofocus
              class="mt-1 block w-full"
              id="email"
              required
              type="email"
              v-model="form.email"
            />
          </div>

          <div class="mt-4">
            <BreezeLabel
              for="password"
              value="Contraseña"
            />
            <BreezeInput
              autocomplete="current-password"
              class="mt-1 block w-full"
              id="password"
              required
              type="password"
              v-model="form.password"
            />
          </div>

          <div class="block mt-4">
            <label class="flex items-center">
              <BreezeCheckbox
                name="remember"
                v-model:checked="form.remember"
              />
              <span class="ml-2 text-sm text-gray-600">Recordar sesión</span>
            </label>
          </div>

          <div class="flex items-center justify-end mt-4">
            <Link
              :href="route('password.request')"
              class="underline text-sm text-gray-600 hover:text-gray-900"
              v-if="canResetPassword"
            >Olvidaste tu contraseña?</Link>

            <BreezeButton
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              class="ml-4"
            >Ingresar</BreezeButton>
          </div>
        </form>
      </div>
    </section>
  </main>
</template>

