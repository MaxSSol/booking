<template>
    <section class="accommodation-image mt-6 px-4 lg:px-0">
        <div class="flex justify-center flex-col">
            <p>Завантажте зображення головної будівлі {{accommodationUnit.title}}</p>
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
import {computed, ref, onMounted} from "vue";
import router from "../router";

export default {
    name: "AccommodationUnitImage",
    props: ['id'],
    setup(props) {
        const store = useStore()
        const accommodationUnit = computed(() => store.getters['owner/getAccommodation'])
        const accommodationImages = ref([])

        onMounted(() => {
            store.dispatch('owner/fetchOwnerAccommodationById', props.id)
        })

        const addImages = (event) => {
            accommodationImages.value = event.target.files
        }

        const uploadImages = () => {
            if (accommodationImages.value) {
                const formData = new FormData()
                for(let i = 0; i < accommodationImages.value.length; i++) {
                    formData.append('image[]', accommodationImages.value[i])
                }
                store.dispatch('owner/addAccommodationUnitImages', formData)
                    .then(() => {
                        alert('Зображення завантаженні успішно. Тепер ви можете додати кімнати.')
                        router.push({name: 'user/owner'})
                    })
            }
        }

        return {
            accommodationUnit,
            addImages,
            uploadImages
        }
    }
}
</script>

<style scoped>

</style>
