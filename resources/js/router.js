import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./components/pages/Home";
import Projects from "./components/pages/Projects";
import Team from "./components/pages/Team";
import Publications from "./components/pages/Publications";
import Profile from "./components/pages/Profile";
import Quotes from "./components/pages/Quotes";

Vue.use(VueRouter);
export default new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/admin",
            name: '/admin/home',
            component: Home
        },
        {
            path: "/admin/quotes",
            name: '/admin/quotes',
            component: Quotes
        },
        {
            path: "/admin/projects",
            name: "/admin/projects",
            component: Projects
        },
        {
            path: "/admin/team",
            name: "/admin/team",
            component: Team
        },
        {
            path: "/admin/publications",
            name: "/admin/publications",
            component: Publications
        },
        ,
        {
            path: "/admin/profile",
            name: "/admin/profile",
            component: Profile
        }
    ]
});
