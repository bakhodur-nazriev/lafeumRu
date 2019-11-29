import Vue from "vue";
import VueRouter from "vue-router";
import Dashboard from "./pages/Dashboard";
import Projects from "./pages/Projects";
import Team from "./pages/Team";
import Publications from "./pages/Publications";
import Profile from "./pages/Profile";

Vue.use(VueRouter);
export default new VueRouter({
    routes: [
        {
            path: "/",
            component: Dashboard
        },
        {
            path: "/projects",
            name: "projects",
            component: Projects
        },
        {
            path: "/team",
            name: "team",
            component: Team
        },
        {
            path: "/publications",
            name: "publications",
            component: Publications
        },
        ,
        {
            path: "/profile",
            name: "profile",
            component: Profile
        }
    ],
    mode: "history"
});
