import { createRouter, createWebHistory } from "vue-router";
import FaqIndex from "../pages/faqs/Index";

const routes = [
    {
        name: "faqs.index",
        path: "/faqs",
        component: FaqIndex,
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
