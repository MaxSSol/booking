<template>
    <button class="py-2 px-8 bg-blue-900 text-white hover:opacity-50">
        {{ title }}
    </button>
</template>

<script>
export default {
    name: "ActionBtn",
    props: {
        title: {
            type: String,
            require:true
        }
    }
}
</script>

<style scoped>

</style>
