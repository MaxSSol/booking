<template>
    <div class="container mx-auto px-2 lg:px-0" v-if="accommodation !== {}">
        <div class="room-main-info ml-2 flex flex-col lg:flex-row lg:justify-between lg:items-center">
            <div class="flex lg:items-center flex-col lg:flex-row">
                <p class="text-sm bg-blue-900
                       text-white text-center px-4
                       py-2 font-bold mr-2"
                   v-for="category in accommodation.categories"
                >
                    {{category.title}}
                </p>
                <p class="text-2xl font-bold">{{ accommodation.title }}</p>
                <p class="text-base ml-0 lg:ml-4">Адреса - {{ accommodation.address }},
                    {{accommodation.city?.title}}</p>
            </div>
            <div>
                <div class="flex flex-col lg:flex-row mt-2">
                    <p class="text-base">Кількість відгуків: {{ countComments }}</p>
                    <p class="text-base ml-0 mt-2 lg:mt-0 lg:ml-4">
                        Оцінка:
                        <span class="bg-blue-900 px-4 py-1 font-bold text-white">
                        {{ totalRating.total_rating }}
                    </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-6 room-images flex flex-col items-center w-full">
            <img id="featured" class="w-full h-full lg:h-4/5 lg:w-4/5 cursor-pointer object-fit px-2"/>

            <div class="thumbnails w-full lg:w-2/3 px-2 flex items-center justify-around">
                <accommodation-images :images="accommodation.accommodation_images"></accommodation-images>
            </div>
        </div>
    </div>
    <section class="accommodation-description mt-6 px-2 lg:px-0">
        <div class="container mx-auto">
            <p class="text-base text-justify">
                Це помешкання розташоване в 18 хв. ходьби від пляжу Арт-готель Vintage розташований в Одесі. До послуг
                гостей ресторан, бар, спільний лаунж і сад. Неподалік розміщені такі популярні пам'ятки, як Одеський
                театр опери й балету, пам'ятник герцогу де Рішельє та Арабський культурний центр. У помешканні
                здійснюється обслуговування номерів. Для гостей організовують трансфер з/до аеропорту. На всій території
                надається безкоштовний Wi-Fi. Стійка реєстрації працює цілодобово.
                У номерах готелю є кондиціонер, письмовий стіл, сейф і телевізор із плоским екраном. Гості користуються
                власною ванною кімнатою з душем. Усі номери готелю Vintage Art також комплектують рушниками та
                постільною білизною.
                Щоранку в помешканні подають континентальний сніданок.
                Неподалік від арт-готелю Vintage розміщені такі популярні місця, як пляж Ланжерон, пляж Відрада та
                Одеський археологічний музей. Відстань від готелю до міжнародного аеропорту Одеси становить 7 км.
                Це улюблений район наших гостей у напрямку Одеса, відповідно до незалежних відгуків.
                Це місце розташування особливо подобається парам - вони оцінили його на 9,3 для поїздки удвох.
                Vintage Art Hotel - приймає гостей Booking.com з 15 бер. 2021
            </p>
        </div>
    </section>
    <section class="accommodation-opportunities mt-4 px-2 lg:px-0">
        <div class="container mx-auto border-t-2">
            <p class="font-bold text-xl mt-2">Можливості</p>
            <div class="opportunities grid grid-cols-1
            sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6
            gap-2 mt-2 justify-items-center lg:justify-items-start"
            >
                <div class="opportunity flex items-center" v-for="opportunity in accommodation.opportunities"
                     :key="opportunity.id">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/time-lapse.png" alt="V"/>
                    <p class="text-xl">{{opportunity.title}}</p>
                </div>
            </div>
        </div>
    </section>
    <section class="room-rating mt-6 px-2">
        <div class="container mx-auto">
            <p class="font-bold text-xl">Відгуки</p>
            <p class="mt-2 px-4 py-2 rounded-lg bg-blue-900 w-[60px] text-center text-white font-bold">
                {{totalRating.total_rating}}
            </p>
            <div class="room-rating-location mt-2">
                <div class="flex justify-between">
                    <p>Розташування</p>
                    <p>{{totalRating.location}}</p>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-blue-600 h-2.5 rounded-full" :style="{width: (totalRating.location * 10 + '%')}">
                    </div>
                </div>
            </div>
            <div class="room-rating-service mt-2">
                <div class="flex justify-between">
                    <p>Обслуговування</p>
                    <p>{{ totalRating.service }}</p>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-blue-600 h-2.5 rounded-full" :style="{width: (totalRating.service * 10 + '%')}">
                    </div>
                </div>
            </div>
            <div class="room-rating-facilities mt-2">
                <div class="flex justify-between">
                    <p>Зручності</p>
                    <p>{{ totalRating.facilities }}</p>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-blue-600 h-2.5 rounded-full" :style="{width: (totalRating.location * 10 + '%')}">
                    </div>
                </div>
            </div>
            <div class="room-rating-price mt-2">
                <div class="flex justify-between">
                    <p>Ціна</p>
                    <p>{{ totalRating.price }}</p>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-blue-600 h-2.5 rounded-full" :style="{width: (totalRating.price * 10 + '%')}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="available-rooms mt-4 px-2 lg:px-0">
        <accommodation-unit-list :accommodation-units="accommodation.accommodation_units"
                                 :days="days"
        >
        </accommodation-unit-list>
        <div class="text-center" v-show="reservation.length > 0">
            <p class="text-xl font-bold">Разом: {{ totalPrice }}</p>
            <button @click="addReservation"
                    class="border text-sm px-4
                    py-2 bg-blue-700 text-white cursor-pointer
                    lg:text-base lg:px-8 lg:py-2 font-bold
                    lg:text-xl mt-2 lg:mt-6 hover:opacity-50"
            >
                Перейти до бронювання
            </button>
        </div>
    </section>
</template>

<script>
import AccommodationImages from "./AccommodationImages";
import AccommodationUnitList from "../AccommodationUnit/AccommodationUnitList";
import {useStore} from "vuex";
import {computed} from "vue";

export default {
    name: "Accommodation",
    components: {AccommodationUnitList, AccommodationImages},
    props: {
        accommodation: {
            type: Object,
            require: true
        },
        totalRating: {
            type: [Object, Number]
        },
        countComments: {
            type: Number
        },
        days: {
            type: Number,
            require: true
        }
    },
    setup() {
        const store = useStore()
        let reservation = computed(() => store.getters['accommodationUnit/getReservationUnits'])
        let totalPrice = computed(() => store.getters['accommodationUnit/getReservationPrice'])



        return {
            reservation,
            totalPrice
        }
    }
}
</script>

<style scoped>

</style>
