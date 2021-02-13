<template>

</template>

<script>
export default {
    name: "Logout",
    async created() {
        try {
            await axios.post('/logout', {})
        } catch (e) {
            console.log(e.response)
        } finally {
            window.location = '/login'
        }
    }
}
</script>

<style scoped>

</style>
