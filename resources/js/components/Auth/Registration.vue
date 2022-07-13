<template>
    <section class="flex justify-center items-center h-screen">
        <div class="flex flex-col items-center w-full lg:w-2/3">
            <p class="text-2xl">Реєстрація</p>
            <div v-show="error">
                <p class="text-base text-red-600 font-bold">
                    Перевірте надані дані.
                    Пароль повинен містити хоча б одну велику та одну малу літеру.
                    Пароль повинен містити хоча б один символ.
                    Пароль повинен містити хоча б одну цифру.
                </p>
            </div>
            <div class="w-full lg:w-2/3">
                <auth-input type="email" name="email" title="Електронна адреса" v-model="v$.email.$model">
                </auth-input>
                <p class="text-red-600 text-sm font-bold" v-show="v$.email.$errors[0]">
                    Обов'язкове для заповнення
                </p>
            </div>
            <div class="w-full lg:w-2/3">
                <auth-input type="text" name="first_name" title="Ім'я" v-model="v$.first_name.$model">
                </auth-input>
                <p class="text-red-600 text-sm font-bold" v-show="v$.first_name.$errors[0]">
                    Обов'язкове для заповнення
                </p>
            </div>
            <div class="w-full lg:w-2/3">
                <auth-input type="password" name="password" title="Пароль" v-model="v$.password.$model"></auth-input>
                <p class="text-red-600 text-sm font-bold" v-show="v$.password.$errors[0]">
                    Обов'язкове для заповнення. Мінімальна довжина 8 символів.
                </p>
            </div>
            <div class="w-full lg:w-2/3">
                <auth-input type="password"
                            name="password_confirmation"
                            title="Підтвердіть пароль ще раз"
                            v-model="v$.password_confirmation.$model"
                >
                </auth-input>
                <p class="text-red-600 text-sm font-bold" v-show="v$.password_confirmation.$errors[0]">
                    Паролі повинні співпадати.
                </p>
            </div>
            <div class="text-center">
                <action-btn title="Зареєструватися" @click="submitForm"></action-btn>
            </div>
        </div>
    </section>
</template>

<script>
import {reactive, computed} from "vue";
import {useStore} from "vuex";
import useVuelidate from "@vuelidate/core";
import {required, email, minLength, sameAs} from "@vuelidate/validators";

import AuthInput from "../UI/AuthInput";
import ActionBtn from "../UI/ActionBtn";
import router from "../../router";

export default {
    name: "Registration",
    components: {AuthInput, ActionBtn},

    setup() {
        const store = useStore();
        let error = computed(() => store.getters['user/getRegistrationErr'])
        let user = reactive({
            email: '',
            first_name: '',
            password: '',
            password_confirmation: ''
        })

        const rules = computed(() => {
            return {
                email: {required, email},
                first_name: {required, minLength: minLength(3)},
                password: {required, minLength: minLength(8)},
                password_confirmation: {required, sameAsPassword: sameAs(user.password)}
            }
        })

        const v$ = useVuelidate(rules, user)

        const submitForm = async () => {
            v$.value.$validate()
            if (v$.value.$errors.length === 0) {
                try {
                    await store.dispatch('user/registration', user)
                        .then(() => {
                            if (localStorage.getItem('reservation')) {
                                return router.push({name: 'reservation'})
                            }
                            router.push('/')
                        })
                        .catch(() => error)

                } catch (error) {
                    console.log(error)
                }
            }
        }


        return {
            user,
            submitForm,
            error,
            v$
        }
    }
}
</script>

<style scoped>

</style>
