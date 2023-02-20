import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        {
            path: '/get', component: () => import("./components/AuthComponents/Get"),
            name: 'get.index'
        },
        {
            path: '/user/login', component: () => import("./components/AuthComponents/Login"),
            name: 'user.login'
        },
        {
            path: '/user/registration', component: () => import("./components/AuthComponents/Registration"),
            name: 'user.registration'
        }
    ]
})
