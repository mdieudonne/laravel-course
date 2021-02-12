<template>
    <div>
        <div v-if="loading">Loading...</div>
        <div v-else>
            <div v-if="contacts.lenth === 0">
                <p>No contacts yet.
                    <router-link :to="{name: 'ContactCreate'}">Fet Started.</router-link>
                </p>
            </div>

            <div v-for="contact in contacts">
                <router-link :to="{name:'ContactsShow', params: {id:contact.data.contact_id}}"
                             class="flex items-center border-b border-gray-400 p-4 hover:bg-gray-100">
                    <user-circle :name="contact.data.name"/>
                    <div class="pl-4">
                        <p class="text-blue-400 font-bold">{{ contact.data.name }}</p>
                        <p class="tetx-gray-600">{{ contact.data.company }}</p>
                    </div>
                </router-link>

            </div>
        </div>
    </div>
</template>

<script>
import UserCircle from "./UserCircle";
export default {
    name: "ContactsList",
    components: {UserCircle},
    data: () => {
        return {
            loading: true,
            contacts: null,
        }
    },
    props: [
      'endpoint'
    ],

    async mounted() {
        try {
            const response = await axios.get(this.endpoint)
            this.contacts = response.data.data
            this.loading = false
        } catch (e) {
            this.loading = false
            alert('Unable to fetch contacts.')
        }
    }
}
</script>

<style scoped>

</style>
