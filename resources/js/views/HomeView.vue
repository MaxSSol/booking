<template>
    <p class="text-3xl">Home</p>
    <router-link :to="{name: 'login'}">
        Login
    </router-link>
</template>

<script>
export default {
    name: "HomeView"
}
</script>

<style scoped>

</style>
