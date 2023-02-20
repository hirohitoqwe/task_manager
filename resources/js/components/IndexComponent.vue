<template>
    <div>
        <div class="use" v-if="access">
            <header-component></header-component>
        </div>
        <div class="login " v-if="!access">
            <router-link :to="{name: 'get.index'}"><button>Get</button></router-link>
            <router-link :to="{name: 'user.login'}"><button>Login</button></router-link>
            <router-link :to="{name: 'user.registration'}"><button>Registration</button></router-link>
            <router-view></router-view>
        </div>
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
            access: false
        }
    },
    mounted() {
        console.log("Index component is started");
    },
    methods: {
        logout() {
            axios.post('/logout').then(response => {
                console.log(response);
            })
        }
    }
}
</script>

<style scoped>
button{
    border: 0;
    width: 90px;
    height: 40px;
}
</style>
