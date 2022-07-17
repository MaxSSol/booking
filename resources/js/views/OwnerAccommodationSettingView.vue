<template>
    <owner-accommodation-setting :id="id"/>
</template>

<script>
import OwnerAccommodationSetting from "../components/OwnerPanel/OwnerAccommodationSetting";
export default {
    name: "OwnerAccommodationSettingView",
    components: {OwnerAccommodationSetting},
    props: ['id']
}
</script>

<style scoped>

</style>
