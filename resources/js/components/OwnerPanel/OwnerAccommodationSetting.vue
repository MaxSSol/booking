<template>
    <tabs-wrapper class="flex-grow">
        <tab :title="'Змінити інформацію'">
            <owner-accommodation-form :id="id"/>
        </tab>
        <tab :title="'Зареєструвати кімнату'">
            <router-link :to="{name: 'owner/accommodation/unit'}" class="hover:opacity-50">
                Зареєструвати кімнату
            </router-link>
        </tab>
    </tabs-wrapper>
</template>

<script>


import TabsWrapper from "../Tabs/TabsWrapper";
import Tab from "../Tabs/Tab";
import OwnerAccommodationForm from "./OwnerAccommodationForm";
import OwnerAccommodationUnitFrom from "./OwnerAccommodationUnitForm";
export default {
    name: "OwnerAccommodationSetting",
    props: ['id'],
    components: {OwnerAccommodationUnitFrom, OwnerAccommodationForm, Tab, TabsWrapper},

}
</script>

<style></style>

