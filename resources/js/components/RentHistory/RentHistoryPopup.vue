<template>
    <div>
        <p class="text-base font-bold">
            Бронювання з: {{rentHistory.rent_date_from}}
        </p>
        <p class="text-base font-bold">
            Бронювання по: {{rentHistory.rent_date_to}}
        </p>
        <p class="text-base font-bold">
            Ціна за ніч: {{rentHistory.price}}
        </p>
        <p class="text-base font-bold">
            Ціна разом: {{rentHistory.total_price}}
        </p>
        <p class="text-base font-bold">
            Статус: {{rentHistory.check_status === 'confirmed' ? 'Підтверджено' : 'Скасовано'}}
        </p>
        <p class="text-base font-bold">
            Коментар: {{rentHistory.comment.length > 0 ? rentHistory.comment : 'немає' }}
        </p>
    </div>
</template>

<script>
export default {
    name: "RentHistoryPopup",
    props: {
        rentHistory: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
