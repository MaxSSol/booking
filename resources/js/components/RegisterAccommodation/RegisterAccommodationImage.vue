<template>
    <section class="accommodation-image mt-6 px-4 lg:px-0">
        <div class="flex justify-center flex-col">
            <p>Завантажте зображення головної будівлі {{accommodation.title}}</p>
            <div>
                <label class="block mb-2 text-base font-medium text-gray-900" for="multiple_files">
                    Завантажте зображення:
                </label>
                <input class="block w-full text-sm
                       text-gray-900 bg-gray-50 rounded-lg
                       border border-gray-300 cursor-pointer
                       focus:outline-none"
                       id="multiple_files"
                       type="file"
                       multiple
                       @change="addImages"
                >
            </div>
            <button class="py-2 px-8 text-white bg-blue-900 font-bold" @click="uploadImages">
                Завантажити
            </button>
        </div>
    </section>
</template>

<script>
import {useStore} from "vuex";
import {computed, ref} from "vue";
import router from "../../router";

export default {
    name: "RegisterAccommodationImage",
    setup() {
        const store = useStore()
        const accommodation = computed(() => store.getters['accommodation/getAccommodation'])
        const accommodationImages = ref([])

        const addImages = (event) => {
            accommodationImages.value = event.target.files
        }

        const uploadImages = () => {
            if (accommodationImages.value) {
                const formData = new FormData()
                for(let i = 0; i < accommodationImages.value.length; i++) {
                    formData.append('image[]', accommodationImages.value[i])
                }
                store.dispatch('accommodation/addAccommodationImage', formData)
                    .then(() => {
                        alert('Зображення завантаженні успішно. Тепер ви можете додати кімнати.')
                        router.push({name: 'user/owner'})
                    })
            }
        }

        return {
            accommodation,
            addImages,
            uploadImages
        }
    }
}
</script>

<style scoped>

</style>
