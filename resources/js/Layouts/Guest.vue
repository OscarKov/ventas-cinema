<template>
  <Navbar />
  <slot />
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/inertia-vue3';

import Navbar from '@/Components/Navbar.vue'

export default {
  components: {
    BreezeApplicationLogo,
    Link,
    Navbar
  }
}
</script>
