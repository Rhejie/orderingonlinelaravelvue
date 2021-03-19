import Vue from 'vue';
import Router from 'vue-router';
import Foods from '../views/Foods.vue';

Vue.use(Router);

const routes = [
    {
        path: "/",
        name: "Foods",
        component: Foods
    },
    {
        path: "/orders",
        name: "Orders",
        component: () => import("../views/Orders.vue")
    }
];

const router = new Router({
    mode: 'history',
    routes: routes,
    linkActiveClass: 'active'
});

export default router;
