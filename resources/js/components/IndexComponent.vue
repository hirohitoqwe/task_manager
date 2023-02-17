<template>
    <div class="form-group">
        <header-component></header-component>
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
