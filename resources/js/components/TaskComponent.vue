<template>
    <ul>
        <li v-for="task in tasks" class="task">
            <p>
                <button><i class="bi bi-check"></i></button>
                {{ task.task_name }}
            </p>
        </li>
        <i class="bi bi-plus-lg" @click.prevent="addInputTask">Добавить</i>
        <div :class=" this.inputTask ? '' : 'd-none' ">
            <input type="text" v-model="newTask.task_name" required>
            <button type="submit" @click.prevent="addTask">Добавить</button>
        </div>
    </ul>

</template>

<script>
export default {//TODO TEST BUTTON
    name: "TaskComponent",
    data() {
        return {
            tasks: null,
            inputTask: false,
            newTask: {
                task_name: null,
                section_id: null,
                user_id: null
            }
        }
    },
    methods: {
        getTasks(section_id) {
            axios.post(`api/section/getTask/${section_id}`).then(response => {
                this.tasks = response.data;
            }).catch(response => {
                console.log(response)
            });
            this.newTask.section_id = section_id;
        },
        /*
        getAllTasks() {
            axios.get('api/tasks').then(response => {
                this.tasks = response.data;
            });
        },*/
        addTask() {
            axios.post('api/task', this.newTask);
            this.getTasks(this.newTask.section_id);
        },
        addInputTask() {
            this.inputTask = !this.inputTask;
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
