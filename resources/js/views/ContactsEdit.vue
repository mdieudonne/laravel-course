<template>
    <div>
        <div class="flex justify-between">
            <div href="#" class="text-blue-400" @click="$router.back()">
                < Back
            </div>
        </div>
        <form @submit.prevent="submitForm">
            <input-field name="name" label="Contact Name" placeholder="Contact Name" :errors="errors"
                         @update:field="form.name = $event" :data="form.name"/>
            <input-field name="email" label="Contact Email" placeholder="Contact Email" :errors="errors"
                         @update:field="form.email = $event" :data="form.email"/>
            <input-field name="company" label="Company" placeholder="Company" :errors="errors"
                         @update:field="form.company = $event" :data="form.company"/>
            <input-field name="birthday" label="Birthday" placeholder="MM/DD/YYYY" :errors="errors"
                         @update:field="form.birthday = $event" :data="form.birthday"/>

            <div class="flex justify-end">
                <button class="py-2 px-4 text-red-700 rounded border mr-5 hover:border-red-700">Cancel</button>
                <button class="bg-blue-500 py-2 px-4 text-white rounded hover:bg-blue-400" @click="submitForm">
                    Save
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import InputField from "../components/InputField";
import axios from "axios";

export default {
    name: "ContactsEdit",
    components: {InputField},
    props: [
        'id'
    ],
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
    async mounted() {
        try {
            const response = await axios.get('/api/contacts/' + this.id)
            this.form = response.data.data
            this.loading = false
        } catch (e) {
            this.loading = false

            if (e.response.status === 404) {
                this.$router.push({name: 'ContactsList'})
            }
        }
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.put('/api/contacts/' + this.id, this.form)
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
