<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import MainLayout from '@/Layouts/Main.vue';
import ListingCarousel from '@/Components/Carousel.vue'

const listingItems = [
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
  <Head title="Inicio" />
  <MainLayout>
    <ListingCarousel :items="listingItems" />
  </MainLayout>
</template>
