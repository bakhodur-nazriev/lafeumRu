import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./components/pages/Home";
import Projects from "./components/pages/Projects";
import Team from "./components/pages/Team";
import Publications from "./components/pages/Publications";
import Profile from "./components/pages/Profile";
import Quotes from "./components/pages/Quotes";
import Authors from "./components/pages/Authors";
import Photos from "./components/pages/Photos";
import Terms from "./components/pages/Terms";
import KnowledgeAreas from "./components/pages/KnowledgeAreas";
import Videos from "./components/pages/Videos";

Vue.use(VueRouter);
export default new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/dashboard",
            name: '/dashboard/home',
            component: Home
        },
        {
            path: "/dashboard/authors",
            name: '/dashboard/authors',
            component: Authors
        },

        {
            path: "/dashboard/quotes",
            name: '/dashboard/quotes',
            component: Quotes
        },
        {
            path: "/dashboard/projects",
            name: "/dashboard/projects",
            component: Projects
        },
        {
            path: "/dashboard/team",
            name: "/dashboard/team",
            component: Team
        },
        {
            path: "/dashboard/publications",
            name: "/dashboard/publications",
            component: Publications
        },
        {
            path: "/dashboard/profile",
            name: "/dashboard/profile",
            component: Profile
        },
        {
            path: "/dashboard/photos",
            name: "/dashboard/photos",
            component: Photos
        },
        {
            path: "/dashboard/terms",
            name: "/dashboard/terms",
            component: Terms
        },
        {
            path: "/dashboard/knowledge_areas",
            name: "/dashboard/knowledge_areas",
            component: KnowledgeAreas
        },
        {
            path: "/dashboard/videos",
            name: "/dashboard/videos",
            component: Videos
        }
    ]
});
