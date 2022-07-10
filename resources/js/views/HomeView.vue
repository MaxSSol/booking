<template>
    <div class="flex-grow">
        <section class="hero mt-24 px-2">
            <div class="container mx-auto">
                <h1 class="text-2xl lg:text-4xl xl:text-6xl font-bold">Знайдіть помешкання для наступної подорожі</h1>
                <p class="mt-8 text-xl">Знаходьте пропозиції готелів, приватних помешкань та багато іншого..</p>
            </div>
        </section>
        <search-form/>
    </div>
</template>

<script>
import SearchForm from "../components/Search/SearchForm";

export default {
    name: "HomeView",
    components: {SearchForm},

}
</script>

<style scoped>

</style>
