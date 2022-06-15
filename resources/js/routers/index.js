import Vue from 'vue'
import VueRouter from 'vue-router'
import main from '../views/main'
import redirect from '../views/redirect'

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            component: main,
            name: 'main',
        },
        {
            path: '/home/:shorturl',
            component: redirect,
            name: 'redirect',
        }
    ],

});
