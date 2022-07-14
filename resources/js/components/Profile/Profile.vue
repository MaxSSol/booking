<template>
    <tabs-wrapper>
        <tab :title="'Бронювання'">
            <rent-history/>
        </tab>
    </tabs-wrapper>
</template>

<script>
import TabsWrapper from "../Tabs/TabsWrapper";
import Tab from "../Tabs/Tab";
import RentHistory from "../RentHistory/RentHistory";

export default {
    name: "Profile",
    components: {RentHistory, Tab, TabsWrapper},
}
</script>

<style scoped>

</style>
