import Vue from 'vue'
import VueRouter from 'vue-router'
import mainPage from '../views/main'
import redirect from '../views/redirect'

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            component: mainPage,
            name: 'main',
        },
        {
            path: '/home/:shorturl',
            component: redirect,
            name: 'redirect',
            props: true
        }
    ],

});
