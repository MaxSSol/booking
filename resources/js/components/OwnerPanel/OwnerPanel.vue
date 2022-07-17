<template>
    <tabs-wrapper>
        <tab :title="'Помешкання'">
            <owner-accommodation/>
        </tab>
    </tabs-wrapper>
</template>

<script>
import TabsWrapper from "../Tabs/TabsWrapper";
import Tab from "../Tabs/Tab";
import OwnerAccommodation from "./OwnerAccommodation";

export default {
    name: "OwnerPanel",
    components: {OwnerAccommodation, Tab, TabsWrapper},
}
</script>

<style scoped>

</style>
