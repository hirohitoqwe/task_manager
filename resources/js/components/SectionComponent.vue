<template>
    <div>
        <div class="sections">
            <h2 @click.prevent="setSelectSection(null)">Sections</h2>
            <div class="section" v-for="section in sections">
                <span @click.prevent="setSelectSection(section.id)">{{ section.section_name }}</span>
                <button type="button" class="close" aria-label="Close" @click.prevent="sectionDelete(section.id)">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <button @click.prevent="inputSection"><i class="bi bi-plus-circle"></i></button>
            <div class="input-group" :class="this.addSectionInput ? '' : 'd-none'">
                <input type="text" class="input-field" v-model="newSection.section_name">
                <button @click.prevent="addSection"><i class="bi bi-check2"></i></button>
            </div>
        </div>
        <task-component ref="TaskComponent"></task-component>
    </div>
</template>

<script>
import TaskComponent from "./TaskComponent";

export default {//TODO test of error span class
    name: "SectionComponent",
    components: {TaskComponent},
    data() {
        return {
            sections: null,
            section_id: null,
            newSection: {
                section_name: null
            },
            addSectionInput: false
        }
    },
    methods: {
        getSections() {
            axios.get('api/section/').then(response => {
                this.sections = response.data;
                console.log(response);
            })
        },
        addSection() {
            axios.post('api/section/create', this.newSection).then(response => console.log(response));
            this.newSection = {section_name: null};
            this.getSections();
        },
        setSelectSection(section_id) {
            console.log('click');
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
            axios.delete(`api/section/${section_id}`).then(response => {
                console.log(response)
            });
        }

    },

    mounted() {
        this.getSections();
        this.$refs.TaskComponent.getAllTasks();
    }

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

.input-field {

}

</style>
