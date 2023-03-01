<template>
    <div>
        <div class="sections">
            <h2 @click.prevent="setSelectSection(null)">Sections</h2>
            <div class="section" v-for="section in getterSections">
                <span @click.prevent="setSelectSection(section.id)">{{ section.section_name }}</span>
                <button type="button" class="close" aria-label="Close" @click.prevent="sectionDelete(section.id)">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <button @click.prevent="this.inputSection"><i class="bi bi-plus-circle"></i></button>
            <div class="input-gr" :class="addSectionInput ? '' : 'd-none'">
                <input type="text" class="input" v-model="newSection.section_name">//TROUBLE
                <button @click.prevent="this.addSection"><i class="bi bi-check2"></i></button>
            </div>
        </div>
        <task-component ref="TaskComponent"></task-component>
    </div>
</template>

<script>
import TaskComponent from "./TaskComponent";
import {mapGetters, mapActions} from "vuex";

export default {
    name: "SectionComponent",
    components: {TaskComponent},
    computed: {
        getterSections() {
            return this.$store.getters.getterSections;
        },
        newSection: {
            get() {
                console.log("NEW SECTION", this.$store.state.newSection);
                return this.$store.getters.getterNewSection;
            },
            set(value) {
                this.$store.state.newSection.section_name = value;
            }
        },
        addSectionInput: {
            get() {
                return this.$store.state.addSectionInput;
            }
        }
    },
    methods: {
        ...mapActions(['getSections', 'changeSectionId', 'addSection', 'inputSection', 'setUserIdAct']),
        sectionDelete(section_id) {
            console.log("Вот секции ", this.sections);
            this.sections = this.sections.filter(elem => elem.id !== section_id);
            axios.delete(`api/section/${section_id}`).then(response => {
                console.log(response)
            });
        },
        setSelectSection(section_id) {
            if (section_id === undefined) {
                this.$refs.TaskComponent.getTasks(null);//TODO IMPROVE
                context.commit('setSectionId', null);
            }
            this.$refs.TaskComponent.getTasks(section_id);
            //context.commit('setSectionId', section_id);
            console.log(`SELECT SECTION ${section_id}`);
        },
    },
    async created() {
        console.log("Created");
        await this.getSections();
    }
    /*
    async mounted() {
        console.log('Section component created');
        let res = await this.getUserId();
        this.$store.dispatch('getSections', res);
        //this.$refs.TaskComponent.newTask.user_id = res;
    }
    /*
    methods: {
        async getUserId() {
            await axios.get('/api/user/id').then(r => {
                console.log(r);
                this.newSection.user_id = r.data;
                console.log(this.user_id);
            });
        },
        getSections() {
            axios.get(`api/section/${this.newSection.user_id}`).then(response => {
                console.log('user id', response);
                this.sections = response.data;
            })
        },
        addSection() {
            axios.post('api/section/create', this.newSection).then(response => {
                console.log(response)
                this.sections.push({
                    id: response.data.id,
                    section_name: response.data.section_name
                });
                console.log(this.sections);
            });
            this.newSection = {section_name: null};
        },
        setSelectSection(section_id) {
            if (section_id === undefined) {
                this.$refs.TaskComponent.getTasks(null);
                this.section_id = null;
                return;
            }
            this.$refs.TaskComponent.getTasks(section_id);
            this.section_id = section_id;
            console.log(`SELECT SECTION ${section_id}`);
        },
        inputSection() {
            console.log(this.addSectionInput)
            this.addSectionInput = !this.addSectionInput;
        },
        sectionDelete(section_id) {
            console.log("Вот секции ", this.sections);
            this.sections = this.sections.filter(elem => elem.id !== section_id);
            axios.delete(`api/section/${section_id}`).then(response => {
                console.log(response)
            });
        }

    },*/


}
</script>

<style scoped>
.sections {
    margin-top: 10px;
    width: 300px;
    height: 100vh;
    float: left;
    box-shadow: inset -2px 0 0 gray;
}

.section {
    cursor: pointer;
    width: 300px;
    margin: 3px;
    font-size: 22px;
    padding: 5px;
}

.close {
    float: right;
    margin-right: 5px;
}

button {
    border: 0;
    background: transparent;
}

i {
    font-size: 20px;
    margin-left: 5px;
}

h2 {
    cursor: pointer;
}

.input {
    border: 1px solid black;
    margin-right: 5px;
    border-radius: 10px;
    height: 35px;
}

</style>
