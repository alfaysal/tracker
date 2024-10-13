import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./pages/Home.vue"),
    },
    {
        path: "/user/registration",
        component: () => import("./pages/Registration.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
