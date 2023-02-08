<template>
    <div class="col-md-6">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-lg-3 navbar-container bg-light">
                    <!-- Вертикальное меню -->
                    <nav class="navbar navbar-expand-md navbar-light">
                        <p class="navbar-brand">Sections</p>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                                aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbar" style="background:#A9A9A9;width: 80%">
                            <!-- Пункты вертикального меню -->
                            <ul class="navbar-nav">
                                <li>
                                    <button type="button" @click.prevent="setSelectSection()"
                                            class="btn btn-outline-secondary">Главная
                                    </button>
                                </li>
                                <li v-for="section in sections">
                                    <button type="button" @click.prevent="setSelectSection(section.id)"
                                            class="btn btn-outline-secondary">{{ section.section_name }}
                                    </button>
                                </li>
                            </ul>

                        </div>
                        <i class="bi bi-plus-lg" @click.prevent="inputSection"></i>
                        <div :class=" this.addSectionInput ? '' : 'd-none' ">
                            <input type="text" v-model="newSection.section_name" required>
                            <button type="submit" @click.prevent="addSection">Добавить</button>
                        </div>
                    </nav>
                </div>
                <div class="col-md-8 col-lg-9 content-container">
                    <task-component ref="TaskComponent"></task-component>
                </div>
            </div>
        </div>
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
            this.$refs.TaskComponent.getTasks(section_id)
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
@media (min-width: 768px) {

    .btn {
        display: block;
        width: 100%;
        border: none;
        padding: 14px 28px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
    }

    .navbar-container {
        position: sticky;
        top: 0;
        overflow-y: auto;
        height: 100vh;
    }

    .navbar-container .navbar {
        align-items: flex-start;
        justify-content: flex-start;
        flex-wrap: nowrap;
        flex-direction: column;
        height: 100%;
    }

    .navbar-container .navbar-collapse {
        align-items: flex-start;
    }

    .navbar-container .nav {
        flex-direction: column;
        flex-wrap: nowrap;
    }

    .navbar-container .navbar-nav {
        flex-direction: column !important;
    }
}
</style>
