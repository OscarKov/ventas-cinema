<script setup>
import { ref, computed, defineProps } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
  items: Array
})

const currentItemIndex = ref(0)

const currentListingItem = computed(() => {
  return props.items[currentItemIndex.value]
})

</script>

<template>
  <section style="background-color: black;">
    <Transition name="fade-in">
      <div
        :key="currentListingItem.id"
        :style="{ backgroundImage: `url(${currentListingItem.poster_url})` }"
        class="listing-container"
      >
        <div class="listing-content px-10 py-7">
          <div class="flex flex-wrap items-center justify-center mx-auto max-w-7xl">
            <div class="w-full md:w-1/2 text-white">
              <div class="flex flex-wrap justify-center">
                <h1 class="w-full text-2xl font-bold">{{ currentListingItem.title }}</h1>
                <p class="w-full">{{ currentListingItem.synopsis }}</p>
              </div>
            </div>
            <div class="w-full md:w-1/2 text-white">
              <div class="flex flex-wrap">
                <div class="w-full">
                  <img
                    :src="currentListingItem.poster_url"
                    alt="poster_url"
                    class="poster_url md:max-w-xs mx-auto"
                  />
                </div>
                <Link
                  :href="route('register')"
                  class="mt-4 mx-auto whitespace-nowrap px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
                >Horarios y entradas</Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </section>
</template>

<style scoped>
.listing-container {
  background-position-x: center;
  background-size: cover;
  border-radius: 0px 0px 5px 5px;
}
.listing-content {
  background: linear-gradient(
    180deg,
    rgba(0, 0, 0, 0) 0%,
    rgba(0, 0, 0, 0.9) 56.25%
  );
}
.fade-in-enter-active {
  transition: opacity 800ms cubic-bezier(0.55, 0.085, 0.68, 0.53);
}
.fade-in-leave-active {
  transition: opacity 300ms cubic-bezier(0.25, 0.46, 0.45, 0.94);
}
.fade-in-enter-from,
.fade-in-leave-to {
  opacity: 0.2;
}
</style>
