import Vue from 'vue'

import IndexComponent from "./components/IndexComponent";

import router from "./router";

require('./bootstrap');

const app = new Vue({
    el: '#app',
    components: {
        IndexComponent
    },
    router
});
