<template>
    <div v-if="error">
        <p class="text-4xl text-red-600 font-bold">Виникла помилка, спробуйте перезавантажити сторінку.</p>
        <router-link :to="{name: 'profile'}">Перезавантажити</router-link>
    </div>
    <div v-else>
        <div v-if="status">
            <p class="text-xl font-bold">Ваш відгук успішно додано</p>
        </div>
        <p class="text-base font-bold">
            Відгук для номеру: {{ accommodationUnit.title }}
        </p>
        <div>
            <label for="message" class="block mb-2 text-base font-bold text-gray-900"
            >
                Відгук
            </label>
            <textarea id="message"
                      rows="4"
                      class="block p-2.5 w-full text-sm text-gray-900
                  bg-gray-50 rounded-lg border border-gray-300
                  focus:ring-blue-500 focus:border-blue-500"
                      placeholder="Ваш відгук..."
                      v-model="v$.comment.$model"
            >
            </textarea>
            <p class="text-red-600 text-sm font-bold" v-show="v$.comment.$errors[0]">
                Обов'язкове для заповнення
            </p>
        </div>
        <div>
            <label for="service" class="block mb-2 text-base font-bold text-gray-900">
                Оцініть обслуговування від 1 до 10
            </label>
            <input type="number"
                   id="service"
                   class="block p-4 w-full text-gray-900 bg-gray-50
               rounded-lg border border-gray-300 sm:text-md
               focus:ring-blue-500 focus:border-blue-500"
                   min="1"
                   max="10"
                   v-model="v$.service.$model"
            />
            <p class="text-red-600 text-sm font-bold" v-show="v$.service.$errors[0]">
                Мінімальне значення: 1 | Максимальне значення: 10
            </p>
        </div>
        <div>
            <label for="facilities" class="block mb-2 text-base font-bold text-gray-900">
                Оцініть зручності від 1 до 10
            </label>
            <input type="number"
                   id="facilities"
                   class="block p-4 w-full text-gray-900 bg-gray-50
               rounded-lg border border-gray-300 sm:text-md
               focus:ring-blue-500 focus:border-blue-500"
                   min="1"
                   max="10"
                   v-model="v$.facilities.$model"
            />
            <p class="text-red-600 text-sm font-bold" v-show="v$.facilities.$errors[0]">
                Мінімальне значення: 1 | Максимальне значення: 10
            </p>
        </div>
        <div>
            <label for="price" class="block mb-2 text-base font-bold text-gray-900">
                Оцініть ціну від 1 до 10
            </label>
            <input type="number"
                   id="price"
                   class="block p-4 w-full text-gray-900 bg-gray-50
               rounded-lg border border-gray-300 sm:text-md
               focus:ring-blue-500 focus:border-blue-500"
                   min="1"
                   max="10"
                   v-model="v$.price.$model"
            />
            <p class="text-red-600 text-sm font-bold" v-show="v$.price.$errors[0]">
                Мінімальне значення: 1 | Максимальне значення: 10
            </p>
        </div>
        <div>
            <label for="location" class="block mb-2 text-base font-bold text-gray-900">
                Оцініть розташування від 1 до 10
            </label>
            <input type="number"
                   id="location"
                   class="block p-4 w-full text-gray-900 bg-gray-50
               rounded-lg border border-gray-300 sm:text-md
               focus:ring-blue-500 focus:border-blue-500"
                   min="1"
                   max="10"
                   v-model="v$.location.$model"
            />
            <p class="text-red-600 text-sm font-bold" v-show="v$.location.$errors[0]">
                Мінімальне значення: 1 | Максимальне значення: 10
            </p>
        </div>
        <div>
            <button @click="addComment" v-if="!status"
                    class="text-base text-white px-8 py-2 bg-blue-900 hover:opacity-50 w-full mt-2"
            >
                Додати відгук
            </button>
        </div>
    </div>
</template>

<script>
import {reactive, computed} from "vue";
import {useStore} from "vuex";
import useVuelidate from "@vuelidate/core";
import {required, maxValue, minValue} from "@vuelidate/validators";

export default {
    name: "CommentForm",
    props: {
        accommodationUnit: {
            type: Object,
            required: true
        }
    },
    setup(props) {
        const store = useStore()

        const status = computed(() => store.getters['accommodationComment/getStatus'])
        const error = computed(() => store.getters['accommodation/getError'])

        const comment = reactive({
            accommodation_unit_id: props.accommodationUnit.id,
            accommodation_id: props.accommodationUnit.accommodation_id,
            comment: '',
            location: 1,
            facilities: 1,
            service: 1,
            price: 1
        })

        const rules = computed(() => {
            return {
                comment: {required},
                location: {required, minValue: minValue(1), maxValue: maxValue(10)},
                service: {required, minValue: minValue(1), maxValue: maxValue(10)},
                price: {required, minValue: minValue(1), maxValue: maxValue(10)},
                facilities: {required, minValue: minValue(1), maxValue: maxValue(10)},
            }
        })

        const v$ = useVuelidate(rules, comment)

        const addComment = () => {
            v$.value.$validate()
            if (v$.value.$errors.length === 0) {
                store.dispatch('accommodationComment/addComment', comment)
                alert('Ваш відгук успішно додано')
            }
        }

        return {
            comment,
            v$,
            addComment,
            status,
            error
        }
    }
}
</script>

<style scoped>

</style>
