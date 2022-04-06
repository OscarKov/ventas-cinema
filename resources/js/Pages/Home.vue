<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import MainLayout from '@/Layouts/Main.vue';
import ListingCarousel from '@/Components/Carousel.vue'

defineProps({
  listingItems: Array
})

</script>

<template>
  <Head title="Inicio" />
  <MainLayout>
    <ListingCarousel :items="listingItems" />
  </MainLayout>
</template>
