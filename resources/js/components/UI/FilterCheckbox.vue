<template>
    <div>
        <input type="checkbox"
               :id="name"
               @change="evt => onChange(evt.target.value)"
               :value="value"
               :checked="modelValue.includes(value)"
               class="mr-2"
        >
        <label :for="name">{{ title }}</label>
    </div>
</template>

<script>
export default {
    name: "FilterCheckbox",
    props: {
        name: {
            type: [String, Number],
            require: true
        },
        title: {
            type: String,
            require: true
        },
        value: {
            type: Number,
            require: true
        },
        modelValue: {
            type: Array,
            default: () => []
        }
    },
    setup(props, {emit}) {
        const onChange = value => {
            if (props.modelValue.includes(value)) {
                emit('update:modelValue', props.modelValue.filter(cv => cv !== value))

            } else {
                emit('update:modelValue', props.modelValue.concat(value))
            }

        }

        return {
            onChange
        }
    }
}
</script>

<style scoped>

</style>
