<template>
    <div v-if="userImage">
        <p class="text-base">Заватажити зображення:</p>
        <div class="flex flex-row justify-between items-center gap-x-6">
            <img :src="'/storage/users/' + userImage"
                 class="w-[80px] h-[80px] rounded-full"
                 alt="Зображення"
            />
            <button @click="deleteImage"
                class="mt-4 md:mt-0 font-bold text-white py-2 px-8 bg-blue-900 hover:opacity-50">
                Видалити
            </button>
        </div>
    </div>
    <div v-else>
        <p class="text-base">Заватажити зображення:</p>
        <div class="flex flex-col md:flex-row items-center justify-content gap-x-4">
            <input @change="addImage"
                   class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer"
                   id="file_input"
                   type="file"
            />
            <button @click="uploadImage"
                    class="mt-4 md:mt-0 font-bold text-white py-2 px-8 bg-blue-900 hover:opacity-50">
                Завантажити
            </button>
        </div>
    </div>
</template>

<script>
import {useStore} from "vuex";
import {ref} from "vue";

export default {
    name: "UserUploadImage",
    props: {
        userImage: {
            type: String,
        }
    },
    setup() {
        const store = useStore();

        const userImage = ref('')

        const addImage = (event) => {
            userImage.value = event.target.files[0]
            console.log(event.target.files)
        }

        const uploadImage = () => {
            if (userImage.value !== '') {
                const formData = new FormData()
                formData.append('image', userImage.value)
                store.dispatch('user/uploadUserImage', formData)
                    .then(() => alert('Зображення успішно змінено'))
                    .catch((errors) => {
                        alert(errors.image.join(' '))
                    })

            }
        }

        const deleteImage = () => {
            store.dispatch('user/deleteUserImage')
            alert('Зображення успішно видалено')
        }

        return {
            uploadImage,
            addImage,
            deleteImage
        }
    }
}
</script>

<style scoped>

</style>
