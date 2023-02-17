<template>
    <div>
        <div class="sections">
            <h2>Sections</h2>
            <div class="section" v-for="section in sections" @click.prevent="setSelectSection(section.id)">
                {{section.section_name}}
                <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <task-component ref="TaskComponent"></task-component>
    </div>
</template>

<script>
import TaskComponent from "./TaskComponent";

export default {
    name: "SectionComponent",
    components: {TaskComponent},
    data() {
        return {
            sections: null,
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
                return;
            }
            this.$refs.TaskComponent.getTasks(section_id);
            console.log(`SELECT SECTION ${section_id}`);
        },
        inputSection() {
            this.addSectionInput = !this.addSectionInput;
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
    width:300px;
    float:left;
    box-shadow: inset -1px 0 0 gray;
}

.section{
    width: 300px;
    margin: 3px;
    font-size: 22px;
    padding: 5px;
}

.close{
    float: right;
}

</style>
