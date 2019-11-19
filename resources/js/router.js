import Vue from "vue";
import VueRouter from "vue-router";
import Dashboard from "./pages/Dashboard";
import Projects from "./pages/Projects";
import Team from "./pages/Team";

Vue.use(
    VueRouter
);
export default new VueRouter(
    {
        routes: [
            {
                path:
                    "/",
                component: Dashboard
            },
            {
                path:
                    "/projects",
                name:
                    "projects",
                component: Projects
            },
            {
                path:
                    "/team",
                name:
                    "team",
                component: Team
            }
        ],
        mode:
            "history"
    }
);
