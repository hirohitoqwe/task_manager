<template>
    <div class="form-group">
        <section-component></section-component>
    </div>
</template>

<script>
import SectionComponent from "./SectionComponent";
import TaskComponent from "./TaskComponent";

export default {
    name: "IndexComponent",
    components: {TaskComponent, SectionComponent},
    mounted() {
        console.log();
    }
}
</script>

<style scoped>

</style>
