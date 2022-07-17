<template>
    <swiper
        :modules="modules"
        :slides-per-view="1"
        :space-between="50"
        navigation
        :pagination="{ clickable: true }"
        :scrollbar="{ draggable: true }"
    >
            <swiper-slide
                v-for="image in images"
                :key="image.id"
            >
                <img class="mx-auto"
                    :src="src  + image.image"
                    alt="Unit"
                />
            </swiper-slide>
    </swiper>
</template>

<script>
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Navigation, Pagination, Scrollbar} from 'swiper'
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';

export default {
    name: "AccommodationImages",
    components: {Swiper, SwiperSlide},
    props: {
        images: {
            type: Array,
            require: true
        },
        src: {
            type: String,
            default: '/storage/accommodation/'
        }
    },
    setup() {
        return {
            modules: [Navigation, Pagination, Scrollbar]
        }
    }

}
</script>

<style scoped>

</style>
