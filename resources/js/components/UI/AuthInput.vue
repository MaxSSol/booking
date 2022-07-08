<template>
    <label :for="name" class="block mb-2 text-base font-medium text-gray-900">{{ title }}</label>
    <input :type="type"
           :id="name"
           @input="updateInput"
           :value="modelValue"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-2"
           :placeholder=" placeholder ">
</template>

<script>
export default {
    name: "AuthInput",
    props: {
        title: {
            type: String,
            require: true
        },
        type: {
            type: String,
            require: true
        },

        name: {
            type: String,
            require: true
        },

        modelValue: {
            type: String,
            default: ''
        },

        placeholder: {
            type: String
        }
    },

    setup(props, { emit }) {
        const updateInput = event => {
            emit('update:modelValue', event.target.value)
        }

        return {
            updateInput
        }
    }
}
</script>

<style scoped>

</style>
