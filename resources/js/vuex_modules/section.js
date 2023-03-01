import task from './task'

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
        }

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
        load: true
    },
    getters: {
        getterSections(state) {
            console.log("state sections ", state.sections)
            return state.sections;
        },
        getterSectionId(state) {
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
        }

    }
}
