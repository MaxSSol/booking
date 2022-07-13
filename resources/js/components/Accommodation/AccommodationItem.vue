<template>
    <div class="photo mx-auto w-[300px] h-[300px] lg:mr-4">
        <img
            :src="accommodation.accommodation_images[0]?.image"
            alt="photo"
        >
    </div>
    <div class="item-info gap-6 w-2/3 flex flex-col justify-between">
        <div class="text-start">
            <p class="text-xl">
                {{ accommodation.title }}
            </p>
            <p class="text-sm">{{ accommodation.city.title }}</p>
            <p>
                {{ accommodation.address }}
            </p>
        </div>
        <div class="w-full lg:w-auto text-center lg:text-right">
            <p class="mt-2 mb-2 text-2xl font-bold">
                Кількість днів: {{ days }}
                Ціна: {{ accommodation.accommodation_units[0].price * days }}
            </p>
            <div class="w-full flex items-center lg:justify-end">
                <router-link :to="{name: 'accommodation-unit', params: {id: accommodation.id}}"
                             class=" border text-sm px-2
                             py-2 bg-blue-700 text-white
                             lg:px-8 lg:py-2 font-bold
                             lg:text-xl mt-2 lg:mt-6 hover:opacity-50"
                >
                    Переглянути наявність місць
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AccommodationItem",
    props: {
        accommodation: {
            type: Object,
            require: true
        },
        days: {
            type: Number,
            require: true
        }
    }
}
</script>

<style scoped>

</style>
