<template>
    <div>
        <form @submit.prevent="submitForm">
            <input-field name="name" label="Contact Name" placeholder="Contact Name" :errors="errors"
                         @update:field="form.name = $event"/>
            <input-field name="email" label="Contact Email" placeholder="Contact Email" :errors="errors"
                         @update:field="form.email = $event"/>
            <input-field name="company" label="Company" placeholder="Company" :errors="errors"
                         @update:field="form.company = $event"/>
            <input-field name="birthday" label="Birthday" placeholder="MM/DD/YYYY" :errors="errors"
                         @update:field="form.birthday = $event"/>

            <div class="flex justify-end">
                <button class="py-2 px-4 text-red-700 rounded border mr-5 hover:border-red-700">Cancel</button>
                <button class="bg-blue-500 py-2 px-4 text-white rounded hover:bg-blue-400" @click="submitForm">Add New
                    Contact
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import InputField from "../components/InputField";

export default {
    name: "ContactsCreate",
    components: {InputField},
    data: () => {
        return {
            form: {
                name: '',
                email: '',
                company: '',
                birthday: '',
            },
            errors: null
        }
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('/api/contacts', this.form)
                this.$router.push({name: 'ContactsShow', params: {id: response.data.data.contact_id}})

            } catch (e) {
                this.errors = e.response.data.errors
            }
        }
    }
}
</script>

<style scoped>

</style>
