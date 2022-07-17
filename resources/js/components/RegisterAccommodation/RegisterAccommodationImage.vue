<template>
  <div>
      {{accommodation.id}}
  </div>
</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";

export default {
    name: "RegisterAccommodationImage",
    setup() {
        const store = useStore()
        const accommodation = computed(() => store.getters['accommodation/getAccommodation'])

        return {
            accommodation
        }
    }
}
</script>

<style scoped>

</style>
