import {createRouter, createWebHistory} from "vue-router";
import comparison from "@/views/report/comparison.vue";
import daily from "@/views/report/daily.vue";
import weekly from "@/views/report/weekly.vue";


import editSiteBar from "@/components/sideBars/edit.vue";
import createSiteBar from "@/components/sideBars/create.vue";
import showSiteBar from "@/components/sideBars/show.vue";
import indexSiteBar from "@/components/sideBars/index.vue";
import createView from "@/views/element/create.vue";
import editView from "@/views/element/edit.vue";
import showView from "@/views/element/show.vue";
import indexView from "@/views/element/index.vue";
import reportBar from "@/components/sideBars/reportBar.vue";



const routes = [
    {
      path: "/",
      name: "home",
      component: {}
    }, {
        path: "/:target",
        name: "universal",
        children: [
            {
                path: "",
                name: "universal_index",
                components: {
                    sideBar: indexSiteBar,
                    default: indexView
                },
            }, {
                path: "create",
                name: "universal_create",
                components: {
                    sideBar: createSiteBar,
                    default: createView
                },
            }, {
                path: ":id",
                name: "universal_show",
                components: {
                    sideBar: showSiteBar,
                    default: showView
                },
            }, {
                path: ":id/edit",
                name: "universal_edit",
                components: {
                    sideBar: editSiteBar,
                    default: editView
                },
            }
        ]
    },
    {
        path: "/report",
        children: [
            {
                path: "daily",
                name: "report-daily",
                components: {
                    sideBar: reportBar,
                    default: daily
                }
            },
            {
                path: "weekly",
                name: "weekly",
                component: weekly
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
