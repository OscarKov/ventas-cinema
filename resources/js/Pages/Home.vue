<template>
  <Head title="Inicio" />
  <GuestLayout>
    <section class="listing-container">
      <div
        class="listing-content flex flex-wrap items-center justify-center px-10 lg:px-20 xl:px-96 py-7"
      >
        <div class="w-full md:w-1/2 text-white">
          <div class="flex flex-wrap justify-center">
            <h1 class="w-full text-2xl font-bold">Titulo Pelicula</h1>
            <p
              class="w-full"
            >Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo dignissimos voluptates ipsa nisi quasi, iure praesentium commodi omnis minima minus. Unde quas vero nam aliquid officia temporibus explicabo modi dolorum!</p>
          </div>
        </div>
        <div class="w-full md:w-1/2 text-white">
          <div class="flex flex-wrap">
            <div class="w-full">
              <img
                alt="poster"
                class="poster md:max-w-xs mx-auto"
                src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/miZFgV81xG324rpUknQX8dtXuBl.jpg"
              />
            </div>
            <div class="mx-auto">Horarios y entradas</div>
          </div>
        </div>
      </div>
    </section>
  </GuestLayout>
</template>

<style scoped>
.listing-container {
  background-position-x: center;
  background-size: cover;
  background-image: url("https://www.themoviedb.org/t/p/w1920_and_h800_multi_faces/1Rr5SrvHxMXHu5RjKpaMba8VTzi.jpg");
  border-radius: 0px 0px 5px 5px;
}
.listing-content {
  background: linear-gradient(
    180deg,
    rgba(0, 0, 0, 0) 0%,
    rgba(0, 0, 0, 0.9) 56.25%
  );
}
</style>

<script>
import GuestLayout from '@/Layouts/Guest.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
  components: {
    GuestLayout,
    Head,
    Link
  }
}

</script>
