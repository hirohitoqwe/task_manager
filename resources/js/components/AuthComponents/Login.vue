<template>
    <div class="row w-25 p-5 mx-auto">
        <input type="email" v-model="email" placeholder="email" class="form-control m-2">
        <input type="password" v-model="password" placeholder="password" class="form-control m-2">
        <input type="submit" @click.prevent="login" value="login" class="form-control  m-2">
    </div>
</template>

<script>
export default {
    name: "Login",

    data() {
        return {
            email: null,
            password: null,
        }
    },

    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {email: this.email, password: this.password}).then(reponse => {
                    console.log(response);
                });
            });

        }
    }
}
</script>

<style scoped>

</style>
