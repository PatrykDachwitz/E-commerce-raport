import {createRouter, createWebHashHistory, createWebHistory} from "vue-router";
import comparison from "@/views/report/comparison.vue";
import daily from "@/views/report/daily.vue";

const routes = [
    {
      path: "/",
      name: "home",
      component: {}
    },
    {
        path: "/report",
        children: [
            {
                path: "daily",
                name: "report-daily",
                component: daily
            },
            {
                path: "weekly",
                name: "weekly",
                component: daily
            },
            {
                path: "comparison",
                name: "report-comparison",
                component: comparison
            }
        ],
    }
];

export const router = createRouter({
    history: createWebHistory(),
    routes
});
