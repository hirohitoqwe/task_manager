<template>
    <div>
        <h1>лежать</h1>
    </div>
</template>

<script>
export default {
    name: "Get",
    mounted() {
        axios.get('/api/tasks').then(response => {
            console.log(response);
        })
    }
}
</script>

<style scoped>

</style>
