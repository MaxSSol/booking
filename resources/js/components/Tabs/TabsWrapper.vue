<template>
    <div class="container mx-auto py-2 border-t-2 px-4 lg:px-0">
        <ul class="flex flex-col md:flex-row gap-x-4 mb-6">
            <li v-for="title in tabTitles" :key="title" @click="selectTitle(title)">
                <p  :class="{'font-bold': title === selectedTitle}"
                    class="text-base hover:font-bold cursor-pointer"
                >
                    {{ title }}
                </p>
            </li>
        </ul>
        <slot/>
    </div>
</template>

<script>
import Tab from "./Tab";
import { ref, provide } from "vue";

export default {
    name: "TabsWrapper",
    components: {Tab},
    setup(props, { slots }) {
        const tabTitles = ref(slots.default().map(tab => tab.props.title))
        const selectedTitle = ref(tabTitles.value[0])
        const selectTitle = (title) => {
            selectedTitle.value = title
        }
        provide('selectedTitle', selectedTitle)
        return {
            selectedTitle,
            selectTitle,
            tabTitles
        }
    }
}
</script>

<style scoped>

</style>
