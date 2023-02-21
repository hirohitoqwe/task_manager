<template>
    <div>
        <div class="login" v-if="!token">
            <router-link :to="{name: 'user.login'}">
                <button>Login</button>
            </router-link>
            <router-link :to="{name: 'user.registration'}">
                <button>Registration</button>
            </router-link>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
import SectionComponent from "./SectionComponent";
import TaskComponent from "./TaskComponent";
import HeaderComponent from "./HeaderComponent";

export default {
    name: "IndexComponent",
    components: {HeaderComponent, TaskComponent, SectionComponent},
    data() {
        return {
            token: null
        }
    },
    methods: {
        getToken() {
            this.token = localStorage.getItem('x_xsrf_token');
        }
    },
    mounted() {
        this.getToken();
        if (this.token) {
            console.log(this.token);
            this.$router.push({name: 'profile.index'});
        }
        console.log("Index component is started");
    }
}
</script>

<style scoped>
button {
    border: 0;
    width: 90px;
    height: 40px;
}
</style>
