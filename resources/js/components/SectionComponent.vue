<template>
    <div class="col-md-6">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-lg-3 navbar-container bg-light">
                    <!-- Вертикальное меню -->
                    <nav class="navbar navbar-expand-md navbar-light">
                        <a class="navbar-brand" href="#">Sections</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                                aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbar" style="background:#A9A9A9;width: 100%">
                            <!-- Пункты вертикального меню -->
                            <ul class="navbar-nav">
                                <li v-for="section in sections">
                                    <a class="nav-link" @click.prevent="setSelectSection(section.id)"><b>{{ section.section_name }}</b></a>
                                </li>
                            </ul>
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
        },
        setSelectSection(section_id) {
            this.$refs.TaskComponent.getTasks(section_id);
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
