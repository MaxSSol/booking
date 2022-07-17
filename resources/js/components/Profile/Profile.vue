<template>
    <tabs-wrapper class="flex-grow">
        <tab :title="'Бронювання'">
            <rent-history/>
        </tab>
        <tab :title="'Налаштування'">
            <user-information/>
        </tab>
        <tab :title="'Зараєструвати своє житло'">
            <register-check/>
        </tab>
        <tab :title="'Особистий кабінет власника'">
            <router-link :to="{name: 'user/owner'}" v-if="ownerStatus" class="hover:opacity-50">
                Перети до кабінета власника
            </router-link>
        </tab>
    </tabs-wrapper>
</template>

<script>
import TabsWrapper from "../Tabs/TabsWrapper";
import Tab from "../Tabs/Tab";
import RentHistory from "../RentHistory/RentHistory";
import UserInformation from "../User/UserInformation";
import { useStore } from "vuex";
import {computed, onMounted} from "vue";
import RegisterCheck from "../RegisterAccommodation/RegisterCheck";


export default {
    name: "Profile",
    components: {RegisterCheck, UserInformation, RentHistory, Tab, TabsWrapper},
    setup() {
        const store = useStore()

        const ownerStatus = computed(() => store.getters['owner/getOwnerStatus'])

        onMounted(() => {
            store.dispatch('owner/fetchOwnerStatus')
            store.dispatch('user/fetchUser')
        })

        return {
            ownerStatus
        }
    }
}
</script>

<style scoped>

</style>
