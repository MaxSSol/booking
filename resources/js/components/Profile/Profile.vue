<template>
    <tabs-wrapper>
        <tab :title="'Бронювання'">
            <rent-history/>
        </tab>
        <tab :title="'Налаштування'">
            <user-information/>
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

export default {
    name: "Profile",
    components: {UserInformation, RentHistory, Tab, TabsWrapper},
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
