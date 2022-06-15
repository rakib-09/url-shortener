import Vue from 'vue'
import VueRouter from 'vue-router'
import home from '../components/app';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            component: home,
            name: 'home',
        }
    ],

});
