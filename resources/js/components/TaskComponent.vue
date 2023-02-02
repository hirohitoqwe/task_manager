<template>
    <ul class="navbar-nav">
        <li v-for="task in tasks">
            <p>{{ task.task_name }}</p>
        </li>
    </ul>
</template>

<script>
export default {
    name: "TaskComponent",
    data() {
        return {
            tasks: null,
            newTask: {
                task_name: null,
                section_id: null,//take from parent?
                user_id: null
            }
        }
    },
    methods: {
        getTasks(section_id) {
            axios.post(`api/section/getTask/${section_id}`).then(response => {
                this.tasks = response.data;
            });
        },
        getAllTasks() {
            axios.get('api/tasks').then(response => {
                this.tasks = response.data;
            });
        },
        addTask() {
            axios.post('api/task', this.newTask);
        }
    },
    mounted() {

    }
}
</script>

<style scoped>

</style>
