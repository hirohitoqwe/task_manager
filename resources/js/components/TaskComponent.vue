<template>
    <div class="tasks">
        <h2>Tasks</h2>
        <div class="task" v-for="task in tasks">
            <input type="checkbox" class="check" :checked="task.task_status ? '' : 'checked'"
                   @click.prevent="changeTaskStatus(task.id)">
            <span class="checkmark">{{ task.task_name }}</span>
            <button type="button" class="close" @click.prevent="deleteTask(task.id)" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <button class="addTaskButton" @click.prevent="addInputTask"><i class="bi bi-plus-circle">Добавить задание</i>
        </button>
        <div class="input-gr" :class="inputTask ? '' : 'd-none'">
            <input type="text" class="input" v-model="newTask.task_name">
            <button @click.prevent="addTask"><i class="bi bi-check2"></i></button>
        </div>
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
                task_status: true,
                user_id: null,
            }
        }
    },
    methods: {
        async getUserId() {
            await axios.get('/api/user/id').then(r => {
                console.log(r);
                this.newTask.user_id = r.data;
                console.log(this.user_id);
            });
        },
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
            axios.get(`api/nullTask/${this.newTask.user_id}`).then(response => {
                console.log('null task ', response);
                this.tasks = response.data;
            });
        },

        changeTaskStatus(task_id) {
            axios.patch(`api/task/${task_id}`).then(response => {
                this.tasks.forEach((element, index) => {
                    if (element.id === task_id) {
                        console.log(element);
                        element.task_status = !element.task_status;
                        console.log(element.task_status);
                    }
                })
            });
        },
        addTask() {
            console.log('Add task ?? ');
            axios.post('api/task', this.newTask).then(response => {
                console.log('TASKA TASKS ', response);
                this.tasks.push({
                    id: response.data.id,
                    task_name: response.data.task_name,
                    task_status: response.data.task_status,
                    user_id: response.data.user_id
                });
                console.log('tasks ', this.tasks);
                this.newTask.task_name = null;
            });

        },
        addInputTask() {
            this.inputTask = !this.inputTask;
        },
        deleteTask(task_id) {
            this.tasks = this.tasks.filter(elem => elem.id !== task_id);
            axios.delete(`api/task/${task_id}`).then(response => {
                console.log(response)
            });
        }
    },
    async mounted() {
        await this.getUserId();
    }
}
</script>

<style scoped>
.tasks {
    margin-top: 10px;
    float: left;
    width: 500px;
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

.check {
    transform: scale(1.3);
    opacity: 0.9;
    cursor: pointer;
}

.input {
    border: 1px solid black;
    margin-right: 5px;
    border-radius: 10px;
    height: 35px;
}

</style>
