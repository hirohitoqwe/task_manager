<template>
    <div class="tasks">
        <h2>Tasks</h2>
        <div class="task" v-for="task in getterTask">
            <input type="checkbox" class="check" :checked="task.task_status ? '' : 'checked'"
                   @click.prevent="changeTaskStatus(task.id)">
            <span class="checkmark" v-if="!task.task_status"><s> {{ task.task_name }}</s></span>
            <span class="checkmark" v-else>{{ task.task_name }}</span>
            <button type="button" class="close" @click.prevent="deleteTask(task.id)" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <button class="addTaskButton" @click.prevent="addInputTask"><i class="bi bi-plus-circle">Добавить задание</i>
        </button>
        <div class="input-gr" :class="getterInputTask ? '' : 'd-none'">
            <input type="text" class="input" v-model="newTask.task_name">
            <button @click.prevent="addTask"><i class="bi bi-check2"></i></button>
        </div>
    </div>
</template>

<script>

import {mapActions} from "vuex";

export default {
    name: "TaskComponent",
    computed: {
        getterTask() {
            return this.$store.getters.getterTask;
        },
        newTask: {
            get() {
                return this.$store.getters.getterNewTask;
            },
            set(value) {
                this.$store.state.newTask.task_name = value;
            }
        },
        getterInputTask() {
            return this.$store.getters.getterInputTask;
        }
    },
    methods: {
        ...mapActions(['getTasks','changeTaskStatus','addInputTask','deleteTask','addTask']),

    },
    mounted() {
        console.log("Task component is started")
        this.getTasks(this.$store.getters.getterSectionId);
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
