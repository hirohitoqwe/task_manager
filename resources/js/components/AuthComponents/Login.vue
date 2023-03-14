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
            axios.get('/sanctum/csrf-cookie').then(rps => {
                axios.post('/login', {email: this.email, password: this.password}).then(response => {
                    console.log(rps, rps.config.headers['X-XSRF-TOKEN']);
                    localStorage.setItem('x_xsrf_token', rps.config.headers['X-XSRF-TOKEN']);
                    this.$parent.token = localStorage.getItem('x_xsrf_token');
                    this.$router.push({name: 'profile.index'});
                });
            });
        }
    }
}
</script>

<style scoped>

</style>
