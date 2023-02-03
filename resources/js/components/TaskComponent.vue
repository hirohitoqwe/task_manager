<template>
    <ul class="navbar-nav">
        <li v-for="task in tasks" class="task">
            <p>
                <button><i class="bi bi-plus-lg"></i></button>
                {{ task.task_name }}
            </p>
        </li>
        <!---<i class="bi bi-plus-lg" @click.prevent="inputSection"></i> TASK ADDED
        <div :class=" this.addSectionInput ? '' : 'd-none' ">
            <input type="text" v-model="newSection.section_name" required>
            <button type="submit" @click.prevent="addSection">Добавить</button>
        </div>-->
    </ul>
</template>

<script>
export default {//TODO TEST BUTTON
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
            this.newTask.section_id = section_id;//???
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
.task {
    font-size: 30px;
}
</style>
