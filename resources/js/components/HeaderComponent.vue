<template>
    <div>
        <header>
            <img height="49px"
                 src="https://sun9-69.userapi.com/impg/PB493qAec2U79Z4QjoVel0KqjeHsLMj-W-5WcQ/OVfAy0wW4Rs.jpg?size=547x193&quality=96&sign=5b118493a9580960e3ebb2e53c5ba4c6&type=album">
            <button @click.prevent="logout" class="profile"><i class="bi bi-person-x"></i></button>
        </header>
        <section-component></section-component>
    </div>
</template>

<script>
import SectionComponent from "./SectionComponent";

export default {
    name: "HeaderComponent",
    components: {SectionComponent},
    methods: {
        logout() {
            axios.post('/logout').then(response => {
                console.log(response);
            })
        }
    }

}
</script>

<style scoped>

header {
    height: 50px;
    background-color: #CCCFEA;
    margin-bottom: 10px;
}

.profile {
    border: 0;
    background: transparent;
    position: absolute;
    right: 0;
}

.bi {
    font-size: 30px;
    color: #0a58ca;
}

</style>
