<script setup>
import { ref, computed } from 'vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'

import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'

const props = defineProps({
  movieShow: Object
})

const selectedSeats = ref([]);

const seatSelected = (index) => {
  return selectedSeats.value.find(element => element == index + 1);
}

const seatSold = (index) => {
  return props.movieShow.sold_seats.find(element => element == index + 1);
}

const purchaseForm = useForm({
  showId: null,
  detail: '',
  seats: [],
})

const toggleSelect = (index) => {
  if (seatSold(index)) {
    return
  }
  if (seatSelected(index) == undefined) {
    selectedSeats.value.push(index + 1)
  } else {
    selectedSeats.value.splice(selectedSeats.value.indexOf(index + 1), 1)
  }
}

const subtotal = () => {
  return props.movieShow.price * selectedSeats.value.length
}

const submitPurchase = () => {
  if (selectedSeats.value.length > 0) {
    purchaseForm.showId = props.movieShow.id
    purchaseForm.seats = selectedSeats.value
    purchaseForm.post(route('purchase'))
  }
}

</script>

<template>
  <div class="max-w-full mt-6 mx-auto">
    <form
      @submit.prevent="submitPurchase"
      action
    >
      <div>
        <h3 class="text-lg">Cantidad de sillas: {{ selectedSeats.length }}</h3>
        <h3 class="text-lg">Subtotal: {{ subtotal() }}</h3>
      </div>
      <div class="p-4 w-3/4 m-auto">
        <BreezeLabel value="Ubicación" />
        <div class="flex flex-wrap justify-center gap-0.5">
          <div
            :class="{
                'seat-selected': seatSelected(index),
                'seat-sold': seatSold(index)
                }"
            :key="index"
            @click="toggleSelect(index)"
            class="seat border-solid border-2 border-sky-500"
            v-for="(seat, index) in movieShow.room.max_quota"
          ></div>
        </div>
      </div>
      <div class="p-4 w-3/4 m-auto">
        <BreezeLabel
          for="detail"
          value="Detalle / Comentario"
        />
        <textarea
          cols="30"
          id="detail"
          name="detail"
          rows="10"
          v-model="purchaseForm.detail"
        ></textarea>
      </div>
      <div>
        <button
          class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500"
          type="submit"
        >Confirmar Compra</button>
      </div>
    </form>
  </div>
</template>

<style scoped>
.seat {
  width: 40px;
  height: 40px;
  cursor: pointer;
}
.seat-selected {
  background-color: #4f46e5;
}
.seat-sold {
  background-color: #b33900;
}
</style>
