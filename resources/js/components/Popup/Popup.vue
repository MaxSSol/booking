<template>
    <div class="fixed inset-0 z-50 bg-neutral-200 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-10">
            <slot/>
            <div class="flex justify-center">
                <button @click="togglePopup"
                        class="mt-4 border py-2 px-4 hover:bg-blue-900 hover:text-white"
                >
                    {{ title }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Popup",
    props: ['togglePopup', 'title']
}
</script>

<style scoped>

</style>
