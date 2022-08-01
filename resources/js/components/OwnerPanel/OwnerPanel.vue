<template>
    <tabs-wrapper class="flex-grow">
        <tab :title="'Помешкання'">
            <owner-accommodation/>
        </tab>
        <tab :title="'Запити на бронювання'">
            <rent-request/>
        </tab>
    </tabs-wrapper>
</template>

<script>
import TabsWrapper from "../Tabs/TabsWrapper";
import Tab from "../Tabs/Tab";
import OwnerAccommodation from "./OwnerAccommodation";
import RentRequest from "../RentRequest/RentRequest";

export default {
    name: "OwnerPanel",
    components: {RentRequest, OwnerAccommodation, Tab, TabsWrapper},
}
</script>

<style scoped>

</style>
