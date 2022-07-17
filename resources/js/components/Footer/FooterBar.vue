<template>
    <footer class="mt-8 border-t-2 px-2">
        <div class="container mx-auto grid gap-5 grid-cols-1 lg:grid-cols-6">
            <div class="flex flex-col">
                <router-link to="/" class="mt-2 hover:text-blue-700">
                    Головна
                </router-link>
                <router-link to="/" class="mt-4 hover:text-blue-700">
                    Обрати помешкання
                </router-link>
                <a href="#" class="mt-4 hover:text-blue-700">
                    Про нас
                </a>
            </div>
        </div>
        <div class="flex justify-center">Booking.com.ua 2022</div>
    </footer>
</template>

<script>
export default {
    name: "FooterBar"
}
</script>

<style scoped>

</style>
