<template>
    <accommodation-unit-setting-form :id="id" />
</template>

<script>
import AccommodationUnitSettingForm from "../components/AccommodationUnit/AccommodationUnitSettingForm";
export default {
    name: "OwnerAccommodationUnitSettingView",
    components: {AccommodationUnitSettingForm},
    props: ['id']
}
</script>

<style scoped>

</style>
