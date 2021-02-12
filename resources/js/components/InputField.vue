<template>
    <div class="relative pb-4">
        <label :for="name" class="text-blue-500 pt-2 uppercase text-xs font-bold absolute">{{ label }}</label>
        <input v-model="value" :id=name type="text"
               class="pt-8 w-full text-gray-900 border-b pb-2 focus:outline-none focus:border-blue-400"
               :placeholder="placeholder"
               :class="errorClass()"
               @input="updateField()">
        <p class="text-red-600 text-sm">{{ errorMessage() }}</p>
    </div>
</template>

<script>
export default {
    name: "InputField",
    props: [
        'name',
        'label',
        'placeholder',
        'errors',
    ],
    data: () => {
        return {
            value: '',
        }
    },
    computed: {
        hasError() {
            return this.errors && this.errors[this.name]?.length > 0
        }
    },
    methods: {
        updateField() {
            this.clearErrors()
            this.$emit('update:field', this.value)
        },
        errorMessage() {
            if (this.hasError) {
                return this.errors[this.name][0]
            }
        },
        clearErrors() {
            if (this.hasError) {
                this.errors[this.name] = null
            }
        },
        errorClass() {
            if (this.hasError) {
                return 'border-red-500 border-b-2'
            }
        }
    }
}
</script>

<style scoped>
</style>
