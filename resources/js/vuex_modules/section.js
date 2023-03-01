import task from './task'

export default {
    actions: {
        async getSections(context) {
            await axios.get('/api/user/id').then(r => {
                axios.get(`api/section/${r.data}`).then(response => {
                    context.commit('setSections', response.data);
                });
            });

        },
        addSection(context) {
            axios.post('api/section/create', this.newSection).then(response => {
                console.log(response)
                context.commit('addNewSection',
                    {
                        id: response.data.id,
                        section_name: response.data.section_name
                    })
                console.log(this.sections);
            });
            this.newSection = {section_name: null};
        },
        inputSection(context) {
            console.log(this.addSectionInput)
            context.commit('changeSectionInputStatus');
        },
        changeSectionId(context, section_id) {
            context.commit('setSectionId', section_id);
        },
        setUserIdAct(context, id) {
            context.commit('setUserId', id);
        }

    },
    mutations: {
        setSections(state, sections) {
            state.sections = sections;
            console.log("YOOOO MUTATIONS ",sections)
        },
        setSectionId(state, section_id) {
            state.section_id = section_id;
        },
        addNewSection(state, section) {
            state.sections.push(section);
        },
        setUserId(state, id) {
            state.newSection.user_id = id;
        },
        changeSectionInputStatus(state) {
            state.addSectionInput = !state.addSectionInput;
        }
    },
    state: {
        sections: [
            {
                section_name:null
            }
        ],
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
            console.log("state sections ",state.sections)
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
        getterNewSection(state){
            return state.newSection;
        }

    }
}
