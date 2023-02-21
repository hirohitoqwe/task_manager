<template>
    <div class="row w-25 m-5 mx-auto">
        <input type="email" v-model="name" placeholder="Name" class="form-control m-2">
        <input type="email" v-model="email" placeholder="Email" class="form-control m-2">
        <input type="password" v-model="password" placeholder="Password" class="form-control m-2">
        <input type="password" v-model="password_confirmation" placeholder="Confirm password" class="form-control m-2">
        <input type="submit" @click.prevent="registr" value="Registration" class="form-control m-2">
    </div>
</template>

<script>
export default {
    name: "Registration",
    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null
        }
    },

    methods: {
        registr() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }).then(response => {
                    localStorage.setItem('x_xsrf_token', response.config.headers['X-XSRF-TOKEN']);
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
