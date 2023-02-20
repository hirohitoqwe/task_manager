<template>
    <div>
        <div class="login">
            <router-link :to="{name: 'get.index'}">
                <button>Get</button>
            </router-link>
            <router-link :to="{name: 'user.login'}">
                <button>Login</button>
            </router-link>
            <router-link :to="{name: 'user.registration'}">
                <button>Registration</button>
            </router-link>
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
    mounted() {
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
