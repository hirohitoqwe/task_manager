import Vue from 'vue'

import IndexComponent from "./components/IndexComponent";

import router from "./router";

import store from "./vuex"

require('./bootstrap');

const app = new Vue({
    el: '#app',
    components: {
        IndexComponent
    },
    store: store,
    router
});
