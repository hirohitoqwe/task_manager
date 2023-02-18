<template>
    <div class="tasks">
        <h2>Tasks</h2>
        <div class="task" v-for="task in tasks">
            <input type="checkbox">
            <span class="checkmark">{{ task.task_name }}</span>
            <button type="button" class="close" @click.prevent="deleteTask(task.id)" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <button><i class="bi bi-plus-circle"></i></button>
    </div>
</template>

<script>
export default {
    name: "TaskComponent",
    data() {
        return {
            tasks: null,
            inputTask: false,
            newTask: {
                task_name: null,
                section_id: null,
                task_status:false,
                user_id: null,
            }
        }
    },
    methods: {
        getTasks(section_id) {
            if (section_id != null) {
                axios.post(`api/section/getTask/${section_id}`).then(response => {
                    this.tasks = response.data;
                }).catch(response => {
                    console.log(response)
                });
            } else {
                this.getAllTasks();
            }
            this.newTask.section_id = section_id;
        },
        getAllTasks() {
            axios.get('api/tasks').then(response => {
                this.tasks = response.data;
            });
        },

        changeTaskStatus(task_id) {
            axios.patch(`api/task/${task_id}`).then(response => {
                console.log(response)
            });
            this.getTasks(this.newTask.section_id);
            console.log(this.newTask.section_id);
        },
        addTask() {
            axios.post('api/task', this.newTask);
            this.newTask.section_id ? this.getTasks(this.newTask.section_id) : this.getAllTasks();

        },
        addInputTask() {
            this.inputTask = !this.inputTask;
        },
        deleteTask(task_id) {
            axios.delete(`api/task/${task_id}`).then(response => {
                console.log(response)
            });
            this.getTasks(this.$parent.section_id);
        }
    },
    mounted() {

    }
}
</script>

<style scoped>
.tasks {
    margin-top: 10px;
    float: left;
    width: 300px;
    margin-left: 10px;
}

.task {
    margin: 3px;
    font-size: 22px;
    padding: 5px;
}

.close {
    float: right;
}

button {
    border: 0;
    background: transparent;
}

i {
    font-size: 20px;
}

</style>
