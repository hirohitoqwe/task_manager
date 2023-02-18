<template>
    <div>
        <header>
            <img height="49px"
                 src="https://sun9-69.userapi.com/impg/PB493qAec2U79Z4QjoVel0KqjeHsLMj-W-5WcQ/OVfAy0wW4Rs.jpg?size=547x193&quality=96&sign=5b118493a9580960e3ebb2e53c5ba4c6&type=album">
        </header>
        <section-component></section-component>
    </div>
</template>

<script>
import SectionComponent from "./SectionComponent";

export default {
    name: "HeaderComponent",
    components: {SectionComponent}
}
</script>

<style scoped>

header {
    height: 50px;
    background-color: #b23636;
    margin-bottom: 10px;
}
</style>
