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
            <button @click.prevent="inputSection"><i class="bi bi-plus-circle"></i></button>
            <div class="input-gr" :class="addSectionInput ? '' : 'd-none'">
                <input type="text" class="input" v-model="newSection.section_name">
                <button @click.prevent="addSection"><i class="bi bi-check2"></i></button>
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
                return this.$store.getters.getterNewSection;
            },
            set(value) {
                this.$store.state.newSection.section_name = value;
            }
        },
        addSectionInput: {
            get() {
                return this.$store.getters.getterAddSectionInput;
            }
        }
    },
    methods: {
        ...mapActions(['getSections','getTasks', 'changeSectionId', 'addSection', 'inputSection', 'sectionDelete','setSelectSection']),
    },
    async created() {
        console.log("Section component is started");
        await this.getSections();
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
