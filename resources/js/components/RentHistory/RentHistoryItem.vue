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
                <div>
                    <popup v-if="rentTrigger" :toggle-popup="rentToggle" :title="'Приховати'">
                        <rent-history-popup :rent-history="rentHistory"/>
                    </popup>
                    <button @click="popupToggle"
                            :disabled="rentHistory.check_status === 'unchecked'"
                            class="text-base text-white px-8 py-2 bg-blue-900 hover:opacity-50 w-full"
                    >
                        Переглянути подробиці
                    </button>
                </div>
                <div>
                    <popup v-if="commentTrigger" :toggle-popup="commentToggle" :title="'Приховати'">
                        <comment-form :accommodation-unit="rentHistory.accommodation_unit"></comment-form>
                    </popup>
                    <button v-if="CurrentDate >= rentHistory.rent_date_to"
                            @click="commentToggle"
                            :disabled="rentHistory.check_status === 'unchecked'"
                            class="text-base text-white px-8 py-2 bg-blue-900 hover:opacity-50 w-full mt-2"
                    >
                        Додати відгук
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AccommodationImages from "../Accommodation/AccommodationImages";
import {ref} from "vue";
import Popup from "../Popup/Popup";
import RentHistoryPopup from "./RentHistoryPopup";
import CurrentDate from "../../helpers/CurrentDate";
import CommentForm from "../Comment/CommentForm";

export default {
    name: "RentHistoryItem",
    components: {CommentForm, RentHistoryPopup, Popup, AccommodationImages},
    props: {
        rentHistory: {
            type: Object,
            require: true
        }
    },
    setup() {
        let rentTrigger = ref(false)
        const rentToggle = () => {
            rentTrigger.value = rentTrigger.value !== true
        }

        let commentTrigger = ref(false)
        const commentToggle = () => {
            commentTrigger.value = commentTrigger.value !== true
        }

        return {
            rentToggle,
            rentTrigger,
            commentToggle,
            commentTrigger,
            CurrentDate
        }
    }
}
</script>

<style scoped>

</style>
