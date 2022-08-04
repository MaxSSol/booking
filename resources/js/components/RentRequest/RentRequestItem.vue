<template>
  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
    {{ rentHistory.accommodation_unit.title }}
  </th>
  <td class="px-6 py-4">
    {{ rentHistory.payment_method.title }}
  </td>
  <td class="px-6 py-4">
    {{ rentHistory.price }} / {{ rentHistory.total_price }}
  </td>
  <td class="px-2 py-4">
    <input type="date" :value="rentHistory.rent_date_from" disabled/>
  </td>
  <td class="px-2 py-4">
    <input type="date" :value="rentHistory.rent_date_to" disabled/>
  </td>
  <td class="px-6 py-4 text-center">
    <popup v-if="popupTrigger" :toggle-popup="popupToggle" :title="'Приховати'">
      <p class="text-xl text-dark">Ім'я: {{ rentHistory.user.first_name }}</p>
      <p class="text-xl text-dark">Електронна адреса: {{ rentHistory.user.email }}</p>
    </popup>
    <button @click="popupToggle"
            class="text-base font-medium text-blue-600 hover:underline"
    >
      Докладніше
    </button>
  </td>
  <td class="px-6 py-4 text-center" v-if="rentHistory.check_status === 'unchecked'">
    <button @click="changeStatus(rentHistory.id, 'confirmed')"
            class="text-base font-medium text-blue-600 hover:underline mr-2"
    >
      Підтвердити
    </button>
    <button @click="changeStatus(rentHistory.id, 'rejected')"
            class="text-base font-medium text-blue-600 hover:underline"
    >
      Скасувати
    </button>
  </td>
  <td class="px-6 py-4 text-center" v-else>
    {{ rentHistory.check_status === 'confirmed' ? 'Підтверджено' : 'Скасовано' }}
  </td>
</template>

<script>

import Popup from "../Popup/Popup";
import {ref} from "vue";
import {useStore} from "vuex";

export default {
  name: "RentRequestItem",
  components: {Popup},
  props: ['rentHistory'],
  setup() {
    const store = useStore()

    const popupTrigger = ref(false)

    const popupToggle = () => {
      popupTrigger.value = popupTrigger.value !== true
    }

    const changeStatus = (id, status) => {
        store.dispatch('owner/updateRentStatus', {id, status})
    }

    return {
      popupTrigger,
      popupToggle,
      changeStatus
    }
  }
}
</script>

<style scoped>

</style>
