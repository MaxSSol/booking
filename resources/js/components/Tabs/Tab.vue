<template>
    <div v-show="title === selectedTitle">
        <slot/>
    </div>
</template>

<script>
import { inject } from "vue";

export default {
    name: "Tab",
    props: {
        title: {
            type: String,
            require: true
        }
    },
    setup() {
        const selectedTitle = inject("selectedTitle")

        return {
            selectedTitle
        }
    }
}
</script>

<style scoped>

</style>
