<template>
    <div class="col-md-6">
        <task-component></task-component>
    </div>
</template>

<script>
import TaskComponent from "./TaskComponent";

export default {
    name: "SectionComponent",
    components: {TaskComponent},
    data() {
        return {
            sections: null,
            newSection: {
                section_name: null
            },
        }
    },
    methods: {
        getSections() {
            axios.get('/section/').then(response => this.sections = response);
        },
        addSection() {
            axios.post('/section/create', this.newSection).then(response => console.log(response));
        }

    }

}
</script>

<style scoped>

</style>
