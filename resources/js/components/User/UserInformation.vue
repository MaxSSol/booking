<template>
    <section class="profile-info">
        <div class="container mx-auto">
            <div v-if="!user.email_verified_at">
                <button class="text-xl text-red-600 hover:opacity-50"
                        @click.once="sendVerifyEmail"
                        v-if="!sendStatus"
                >
                    Підтвердити електронну адресу
                </button>
                <p v-else class="text-xl">Повідомлення відправлено</p>
            </div>
            <p class="text-base mt-4">Особисті дані:</p>
            <div class="profile-info-form flex flex-col lg:flex-row">
                <div class="flex flex-col w-full">
                    <setting-input v-model="user.first_name"
                                   :disabled="true"
                                   :title="'Ім\'я'"
                                   :name="'first_name'"
                    />
                    <setting-input v-model="user.last_name"
                                   :disabled="true"
                                   :title="'Прізвище'"
                                   :name="'last_name'"
                    />
                    <setting-input v-model="user.email"
                                   :disabled="true"
                                   :title="'Електронна адреса'"
                                   :name="'email'"
                    />
                    <setting-input v-model="user.tel_num"
                                   :disabled="true"
                                   :title="'Номер телефону'"
                                   :name="'tel_num'"
                    />
                    <setting-input v-model="user.birth_date"
                                   :disabled="true"
                                   :title="'Дата нароження'"
                                   :name="'birth_date'"
                    />
                    <setting-input v-model="user.sex"
                                   :disabled="true"
                                   :title="'Стать'"
                                   :name="'sex'"
                    />
                    <setting-input v-model="user.country"
                                   :disabled="true"
                                   :title="'Країна'"
                                   :name="'country'"
                    />
                    <setting-input v-model="user.city"
                                   :disabled="true"
                                   :title="'Місто'"
                                   :name="'city'"
                    />
                    <div v-if="user.image">
                        <p class="text-base">Зображення:</p>
                        <img :src="'/storage/users/' + user.image"
                             class="w-[80px] h-[80px] rounded-full"
                             alt="Зображення"
                        />
                    </div>
                    <div v-else>
                        <p class="text-base">Зображення:</p>
                        <p class="text-base">
                            У вас немає зображення
                        </p>
                    </div>
                    <div class="mt-4 text-center">
                        <router-link :to="{name: 'user/settings'}"
                           class="font-bold text-white py-2 px-8 bg-blue-900 hover:opacity-50"
                        >
                            Внести зміни
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import SettingInput from "../UI/SettingInput";
import {useStore} from "vuex";
import {computed, ref} from "vue";
import axios from "axios";

export default {
    name: "UserInformation",
    components: {SettingInput},
    setup() {
        const sendStatus = ref(false)
        const store = useStore();

        const user = computed(() => store.getters['user/user'])

        const sendVerifyEmail = () => {
            axios.post('/api/email/verification-notification')
                .then(() => {
                    alert('Повідомлення для підтвердження відправлено.')
                    sendStatus.value = true
                })
                .catch(() => alert('На жаль при відправлені сталась помилка. Спробуйте пізніше.'))
        }

        return {
            user,
            sendVerifyEmail,
            sendStatus
        }
    }

}
</script>

<style scoped>

</style>
