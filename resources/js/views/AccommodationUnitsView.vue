<template>
    <p>id: {{id}}</p>
</template>

<script>
import {useStore} from "vuex";
import { onMounted } from "vue";
import router from "../router";

export default {
    name: "AccommodationUnitsPage",
    props: {
        id: {
            type: String,
            require: true
        }
    },
    setup(props) {
        let id = props.id

        const store = useStore();
        let searchParams = store.state.search.search

        onMounted(() => {
            console.log(searchParams)
            if (searchParams === null) {
                alert('Додайте дані для пошуку')
                router.push({name: 'home'})
            }
        })


        return {
            id
        }
    }
}
</script>

<style scoped>

</style>
