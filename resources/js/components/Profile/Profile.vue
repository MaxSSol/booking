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
    </tabs-wrapper>
</template>

<script>
import TabsWrapper from "../Tabs/TabsWrapper";
import Tab from "../Tabs/Tab";
import RentHistory from "../RentHistory/RentHistory";
import UserInformation from "../User/UserInformation";
import { useStore } from "vuex";
import { onMounted } from "vue";
import RegisterCheck from "../RegisterAccommodation/RegisterCheck";


export default {
    name: "Profile",
    components: {RegisterCheck, UserInformation, RentHistory, Tab, TabsWrapper},
    setup() {
        const store = useStore()

        onMounted(() => {
            store.dispatch('user/fetchUser')
        })
    }
}
</script>

<style scoped>

</style>
