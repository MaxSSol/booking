<template>
    <div v-if="!user.email_verified_at">
        <p class="text-2xl">Для того щоб зареєструвати своє житло, треба підтвердити електронну адресу</p>
    </div>
    <div v-else>
        <router-link :to="{name: 'user/accommodation'}"
                     class="font-bold text-white py-2 px-8 bg-blue-900 hover:opacity-50"
        >
            Зареєструвати житло
        </router-link>
    </div>
</template>

<script>
import { useStore } from "vuex";
import { computed } from "vue";

export default {
    name: "RegisterCheck",
    setup() {
        const store = useStore()

        const user = computed(() => store.getters['user/user'])

        return {
            user
        }
    }
}
</script>

<style scoped>

</style>
