export default {
    actions: {
        async getSections(context) {
            await axios.get('/api/user/id').then(r => {
                context.commit('setUserId', r.data)
                axios.get(`api/section/${r.data}`).then(response => {
                    context.commit('setSections', response.data);
                });
            });

        },
        addSection({commit, state}) {
            console.log("NEW SECTION", this.newSection)
            axios.post('api/section/create', state.newSection).then(response => {
                console.log(response)
                commit('addNewSection',
                    {
                        id: response.data.id,
                        section_name: response.data.section_name
                    })
                console.log(this.sections);
            });
            commit('nullOfNullSection');
        },
        inputSection(context) {
            console.log(this.addSectionInput)
            context.commit('changeSectionInputStatus');
        },
        changeSectionId(context, section_id) {
            context.commit('setSectionId', section_id);
        },
        sectionDelete(context, section_id) {
            context.commit('removeSection', section_id);
        },
        setSelectSection(context, section_id) {//TODO IMPROVE
            if (section_id === undefined) {
                context.commit('setSectionId', null);
                task.actions.getTasks.getTasks(null);
            } else {
                context.commit('setSectionId', section_id);
                task.actions.getTasks(section_id);
                console.log(`SELECT SECTION ${section_id}`);
            }
        },
        async getTasks(context, section_id) {
            console.log("get tasks ASYNC", section_id);
            if (section_id != null) {
                await axios.post(`api/section/getTask/${section_id}`).then(response => {
                    context.commit('updateTasks', response.data);
                }).catch(response => {
                    console.log(response)
                });
            } else {
                console.log("HEY WE CALL ", section_id)
                await axios.get('/api/user/id').then(r => {
                    context.commit('changeUserId', r.data);
                    axios.get(`api/nullTask/${r.data}`).then(response => {
                        console.log('null task ', response);
                        context.commit('updateTasks', response.data);
                    });
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
        async addTask({commit, state}) {
            console.log('Add task ?? ');
            await axios.post('api/task', state.newTask).then(response => {
                commit('addTask', {
                    id: response.data.id,
                    task_name: response.data.task_name,
                    task_status: response.data.task_status,
                    user_id: response.data.user_id
                })
                console.log('TASKA TASKS ', response);
                console.log('tasks ', this.tasks);
                state.newTask.task_name = null;
            });
        },
        async addInputTask(context) {
            context.commit('changeInputTask')
        },
        async changeTaskStatus(context, task_id) {
            await axios.patch(`api/task/${task_id}`).then(response => {
                console.log(response);
                context.commit('changeTaskStatus', task_id);
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
        setSections(state, sections) {
            state.sections = sections;
            console.log("YOOOO MUTATIONS ", sections)
        },
        setSectionId(state, section_id) {
            state.section_id = section_id;
        },
        addNewSection(state, section) {
            state.sections.push(section);
        },
        changeSectionInputStatus(state) {
            state.addSectionInput = !state.addSectionInput;
            console.log("Mutation ", state.addSectionInput)
        },
        removeSection(state, section_id) {
            state.sections = state.sections.filter(elem => elem.id !== section_id);
            axios.delete(`api/section/${section_id}`).then(response => {
                console.log(response)
            });
        },
        nullOfNullSection(state) {
            state.newSection.section_name = null;
        },
        setUserId(state, user_id) {
            state.newSection.user_id = user_id;
        },
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
        changeTaskStatus(state, task_id) {
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
        },
        changeInputTask(state) {
            state.inputTask = !state.inputTask;
        }
    },
    state: {
        sections: null,
        section_id: null,
        newSection: {
            section_name: null,
            user_id: null
        },
        addSectionInput: false,
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
        getterSections(state) {
            console.log("state sections ", state.sections)
            return state.sections;
        },
        getterSectionId(state) {
            console.log("getterSectionId")
            return state.section_id;
        },
        getterAddSectionInput(state) {
            return state.addSectionInput;
        },
        getterUserId(state) {
            return state.newSection.user_id;
        },
        getterNewSection(state) {
            return state.newSection;
        },
        getterTask(state) {
            return state.tasks;
        },
        getterInputTask(state) {
            return state.inputTask;
        },
        getterNewTask(state) {
            return state.newTask;
        },
    }
}
