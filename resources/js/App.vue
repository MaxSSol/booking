<template>
    <div class="flex flex-col h-screen container mx-auto px-4 lg:px-0">
        <header-bar/>
        <router-view/>
        <footer-bar/>
    </div>
</template>

<script>
import HeaderBar from "./components/Header/HeaderBar";
import FooterBar from "./components/Footer/FooterBar";

export default {
    name: "App",
    components: {FooterBar, HeaderBar}
}
</script>

<style scoped>

</style>
