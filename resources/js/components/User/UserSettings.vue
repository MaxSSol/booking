<template>
    <section class="profile-info">
        <div class="container mx-auto">
            <p class="font-bold text-2xl">Зміна особистих даних</p>
            <p class="text-base mt-4">Особисті дані:</p>
            <div class="profile-info-form flex flex-col lg:flex-row">
                <div class="flex flex-col w-full">
                    <setting-input v-model="v$.first_name.$model"
                                   :title="'Ім\'я'"
                                   :name="'first_name'"
                    />
                    <p class="text-red-600 text-sm font-bold" v-show="v$.first_name.$errors[0]">
                        Дане поле є обов'язковим. Максимальна довжина 70 символів.
                    </p>
                    <setting-input v-model="v$.last_name.$model"
                                   :title="'Прізвище'"
                                   :name="'last_name'"
                    />
                    <p class="text-red-600 text-sm font-bold" v-show="v$.last_name.$error">
                        Максимальна довжина 70 символів.
                    </p>
                    <setting-input v-model="v$.email.$model"
                                   :title="'Електронна адреса'"
                                   :name="'email'"
                    />
                    <p class="text-red-600 text-sm font-bold" v-show="v$.email.$error">
                        Введіть правильну електронну адресу
                    </p>
                    <setting-input v-model="v$.tel_num.$model"
                                   :title="'Номер телефону'"
                                   :name="'tel_num'"
                    />
                    <p class="text-red-600 text-sm font-bold" v-show="v$.tel_num.$error">
                        Номер телефону повинен починатися з +38 та мати 9 цифр
                    </p>
                    <setting-input v-model="user.birth_date"
                                   :type="'date'"
                                   :title="'Дата нароження'"
                                   :name="'birth_date'"
                    />
                    <p>Оберіть стать</p>
                    <select class="mt-4 bg-gray-50 border border-gray-300
                            text-gray-900 text-sm rounded-lg focus:ring-blue-500
                            focus:border-blue-500 block w-full p-2.5"
                            v-model="user.sex"
                    >
                        <option selected disabled value="1">Оберіть стать</option>
                        <option value="male">Чол</option>
                        <option value="female">Жін</option>
                    </select>
                    <setting-input v-model="v$.country.$model"
                                   :title="'Країна'"
                                   :name="'country'"
                    />
                    <p class="text-red-600 text-sm font-bold" v-show="v$.country.$error">
                        Максимальна довжина 70 символів.
                    </p>
                    <setting-input v-model="v$.city.$model"
                                   :title="'Місто'"
                                   :name="'city'"
                    />
                    <p class="text-red-600 text-sm font-bold" v-show="v$.city.$error">
                        Максимальна довжина 70 символів.
                    </p>
                    <setting-input v-model="v$.password.$model"
                                   :type="'password'"
                                   :title="'Пароль'"
                                   :name="'password'"
                    />
                    <p class="text-red-600 text-sm font-bold" v-show="v$.password.$error">
                        Мінімальна довжина 8 символів.
                        Пароль повинен містити хоча б одну велику та одну малу літеру.
                        Пароль повинен містити хоча б один символ.
                        Пароль повинен містити хоча б одну цифру..
                    </p>
                    <setting-input v-show="user.password"
                                   :type="'password'"
                                   v-model="v$.password_confirmation.$model"
                                   :title="'Підтвердіть пароль'"
                                   :name="'password_confirmation'"
                    />
                    <p class="text-red-600 text-sm font-bold" v-show="v$.password_confirmation.$error">
                        Паролі повинні співпадати.
                    </p>
                    <div class="mt-4 text-center">
                        <button @click="submitForm"
                                class="font-bold text-white py-2 px-8 bg-blue-900 hover:opacity-50"
                        >
                            Внести зміни
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {useStore} from "vuex";
import {computed, ref, reactive} from "vue";
import SettingInput from "../UI/SettingInput";
import router from "../../router";
import {useVuelidate} from "@vuelidate/core";
import {requiredIf, email, minLength, sameAs, maxLength, required} from "@vuelidate/validators";
import {ukTelNum} from "../../helpers/validators";

export default {
    name: "UserSettings",
    components: {SettingInput},
    setup() {
        const sendStatus = ref(false)
        const store = useStore();

        const user = reactive({
            ...store.state.user.user,
            password: '',
            password_confirmation: '',
        })

        const rules = computed(() => {
            return {
                first_name: { required, maxLength: maxLength(70)},
                last_name: {maxLength: maxLength(70)},
                tel_num: {ukTelNum},
                email: {email},
                country: {maxLength: maxLength(70)},
                city: {maxLength: maxLength(70)},
                password: {minLength: minLength(8)},
                password_confirmation: {
                    requiredIf: requiredIf(function () {
                        return user.password !== ''
                    }),
                    sameAsPassword: sameAs(user.password)
                }
            }
        })

        const v$ = useVuelidate(rules, user)

        const submitForm = () => {
            v$.value.$validate()
            if (v$.value.$errors.length === 0) {
                store.dispatch('user/updateUserInformation', user)
                router.push({name: 'profile'})
            }
        }


        return {
            user,
            sendStatus,
            v$,
            submitForm,
        }
    }
}
</script>

<style scoped>

</style>
