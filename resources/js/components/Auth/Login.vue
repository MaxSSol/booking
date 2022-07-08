<template>
    <section class="flex justify-center items-center h-screen">
        <div class="flex flex-col items-center w-full lg:w-2/3">
            <div v-show="error">
                <p class="text-base text-red-600 font-bold">Перевірте надані дані</p>
            </div>
            <div class="w-full lg:w-2/3">
                <auth-input type="email" name="email" title="Електронна адреса" v-model="v$.email.$model">
                </auth-input>
                <p class="text-red-600 text-sm font-bold" v-show="v$.email.$errors[0]">
                    Обов'язкове для заповнення
                </p>
            </div>
            <div class="w-full lg:w-2/3">
                <auth-input type="password" name="password" title="Пароль" v-model="v$.password.$model"></auth-input>
                <p class="text-red-600 text-sm font-bold" v-show="v$.password.$errors[0]">
                    Обов'язкове для заповнення. Мінімальна довжина 8 символів.
                </p>
            </div>
            <div class="text-center">
                <action-btn title="Увійти" @click="submitForm"/>
            </div>
        </div>
    </section>
</template>

<script>
import { reactive, computed } from "vue";
import {useStore} from "vuex";
import useVuelidate from "@vuelidate/core";
import { required, email, minLength } from "@vuelidate/validators";

import AuthInput from "../UI/AuthInput";
import ActionBtn from "../UI/ActionBtn";
import router from "../../router";

export default {
    name: "Login",
    components: {ActionBtn, AuthInput},

    setup() {
        const store = useStore();
        let error = computed(() => store.getters.getError)
        let user = reactive({
            email: '',
            password: ''
        })

        const rules = computed(() => {
            return {
                email: {required, email},
                password: {required, minLength: minLength(8)}
            }
        })

        const v$ = useVuelidate(rules, user)

        const submitForm = async () => {
            try {
                await store.dispatch('login', user)
                await router.push({name: 'home'})
            } catch (e) {
                error = true
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
