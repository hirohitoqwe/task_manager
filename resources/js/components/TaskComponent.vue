<template>

</template>

<script>
export default {
    name: "TaskComponent",
    data() {
        return {
            tasks: null,
            newTask:{
                task_name:null,
                section_id:null,//take from parent?
                user_id:null
            }
        }
    },
    methods: {
        getTasks(section_id) {
            axios.post(`section/getTask/${section_id}`).then(response => this.tasks)
        },
        addTask(){
            axios.post('/task',{});
        }
    }
}
</script>

<style scoped>

</style>
