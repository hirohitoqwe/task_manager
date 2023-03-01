export default {
    actions: {
        async getTasks(context, section_id) {
            if (section_id != null) {
                await axios.post(`api/section/getTask/${section_id}`).then(response => {
                    context.commit('updateTasks', response.data);
                }).catch(response => {
                    console.log(response)
                });
            } else {
                await axios.get(`api/nullTask/${this.newTask.user_id}`).then(response => {
                    console.log('null task ', response);
                    context.commit('updateTasks', response.data);
                });
            }
            context.commit('changeNewTaskSectionId', section_id);
        },
        async deleteTask(context, task_id) {
            context.commit('deleteTask', task_id);
            axios.delete(`api/task/${task_id}`).then(response => {
                console.log(response)
            });
        },
        async addTask(context) {
            console.log('Add task ?? ');
            await axios.post('api/task', this.newTask).then(response => {
                console.log('TASKA TASKS ', response);
                context.commit('addTask', {
                    id: response.data.id,
                    task_name: response.data.task_name,
                    task_status: response.data.task_status,
                    user_id: response.data.user_id
                })
                console.log('tasks ', this.tasks);
                this.newTask.task_name = null;
            });

        },
        async changeTaskStatus(context, task_id) {
            await axios.patch(`api/task/${task_id}`).then(response => {
                context.commit('changeTaskStatusStatus', task_id);
            });
        },
        async getUserId(context) {
            await axios.get('/api/user/id').then(r => {
                console.log(r);
                context.commit('changeUserId', r.data);
                console.log(this.user_id);
            });
        },

    },
    mutations: {
        updateTasks(state, tasks) {
            state.tasks = tasks;
        },
        changeNewTaskSectionId(state, section_id) {
            state.newTask.section_id = section_id;
        },
        deleteTask(state, task_id) {
            state.tasks = state.tasks.filter(elem => elem.id !== task_id);
        },
        addTask(state, newTask) {
            state.tasks.push(newTask)
        },
        changeTaskStatusStatus(state, task_id) {
            state.tasks = state.tasks.forEach((element, index) => {
                if (element.id === task_id) {
                    console.log(element);
                    element.task_status = !element.task_status;
                    console.log(element.task_status);
                }
            });
        },
        changeUserId(state, user_id) {
            state.newTask.user_id = user_id;
        }

    },
    state: {
        tasks: null,
        inputTask: false,
        newTask: {
            task_name: null,
            section_id: null,
            task_status: true,
            user_id: null,
        }
    },
    getters: {
        TaskGetter(state, section_id) {
            return state.tasks;
        },
        inputTaskGetter(state) {
            return state.inputTask;
        },
        newTaskGetter(state) {
            return state.newTask;
        },

    }
}
