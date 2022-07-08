<template>
    <header-bar/>
    <router-view/>
</template>

<script>
import HeaderBar from "./components/Header/HeaderBar";
export default {
    name: "App",
    components: {HeaderBar}
}
</script>

<style scoped>

</style>
