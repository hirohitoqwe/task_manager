<template>
    <div>
        <router-link :to="{name: 'get.index'}">Get</router-link>
        <router-link :to="{name: 'user.login'}">Login</router-link>
        <router-link :to="{name: 'user.registration'}">Registration</router-link>
        <router-view></router-view>
        <!---<header-component></header-component>--->
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
        console.log();
    }
}
</script>

<style scoped>

</style>
