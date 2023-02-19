<template>
    <div>
        <input type="email" v-model="name" placeholder="name" class="form-control">
        <input type="email" v-model="email" placeholder="email" class="form-control">
        <input type="password" v-model="password" placeholder="password" class="form-control">
        <input type="password" v-model="password_confirmation" placeholder="password" class="form-control">
        <input type="submit" @click.prevent="registr" value="login" class="form-control">
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
                    console.log(response);
                });
            });
        }
    }
}
</script>

<style scoped>

</style>
