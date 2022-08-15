<template>
    <div :class="{'opacity-50': rentHistory.check_status === 'unchecked'}"
         class="rent-history mt-12">
        <p class="text-xl font-bold">{{ rentHistory.accommodation_unit.city.title }}</p>
        <p class="text-sm">{{ rentHistory.rent_date_from }} - {{ rentHistory.rent_date_to }}</p>
        <div class="rent-history-room flex flex-col
             md:flex-row justify-center md:justify-between
             mt-6 p-4 border">
            <accommodation-images :src="'/storage/accommodation/units/'"
                                  :images="rentHistory.accommodation_unit?.accommodation_unit_images"
                                  class="h-[200px] w-full lg:w-[400px]"
            />
            <div class="w-2/3 rent-history-room-info ml-0 md:ml-4">
                <p class="text-xl">{{ rentHistory.accommodation_unit.title }}</p>
                <p class="text-sm">{{ rentHistory.rent_date_from }} - {{ rentHistory.rent_date_to }}</p>
                <p>{{ rentHistory.accommodation_unit.city.title }}</p>
                <p class="font-bold" v-if="rentHistory.check_status === 'confirmed'">Підтверджено</p>
                <p class="font-bold" v-else-if="rentHistory.check_status === 'rejected'">Скасовано</p>
                <p class="font-bold" v-else>В обробці</p>
            </div>
            <div class="flex flex-col justify-between items-center">
                <div>
                    <p class="text-xl font-bold">Ціна за добу: {{ rentHistory.price }}</p>
                    <p class="text-xl font-bold">Разом: {{ rentHistory.total_price }}</p>
                </div>
                <popup v-if="popupTrigger" :toggle-popup="popupToggle" :title="'Приховати'">
                    <rent-history-popup :rent-history="rentHistory"/>
                </popup>
                <button @click="popupToggle"
                        :disabled="rentHistory.check_status === 'unchecked'"
                        class="text-base text-white px-8 py-2 bg-blue-900 hover:opacity-50"
                >
                    Переглянути подробиці
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import AccommodationImages from "../Accommodation/AccommodationImages";
import {ref} from "vue";
import Popup from "../Popup/Popup";
import RentHistoryPopup from "./RentHistoryPopup";

export default {
    name: "RentHistoryItem",
    components: {RentHistoryPopup, Popup, AccommodationImages},
    props: {
        rentHistory: {
            type: Object,
            require: true
        }
    },
    setup() {
        let popupTrigger = ref(false)
        const popupToggle = () => {
            popupTrigger.value = popupTrigger.value !== true
        }

        return {
            popupToggle,
            popupTrigger
        }
    }
}
</script>

<style scoped>

</style>
