import {createRouter, createWebHashHistory, createWebHistory} from "vue-router";
import reportDaily from "@/views/reportDaily.vue";
import reportComparison from "@/views/reportComparison.vue";

const routes = [
    {
      path: "/",
      name: "home",
      component: reportDaily
    },
    {
        path: "/report",
        children: [
            {
                path: "daily",
                name: "report-daily",
                component: reportDaily
            },
            {
                path: "comparison",
                name: "report-comparison",
                component: reportComparison
            }
        ],
    }
];

export const router = createRouter({
    history: createWebHistory(),
    routes
});
