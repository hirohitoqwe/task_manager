import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: '/get', component: () => import("./components/AuthComponents/Get"),
            name: 'get.index'
        },
        {
            path: '/profile', component: () => import("./components/HeaderComponent"),
            name: 'profile.index'
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
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token');
    if (!token) {
        if (to.name === 'user.login' || to.name === 'user.registration') {
            return next();
        } else {
            return next({
                name: 'user.login'
            })
        }
    }

    if (to.name === 'user.login' || to.name === 'user.registration' && token) {
        return next({name: 'get.index'});
    }

    next();

});

export default router;
