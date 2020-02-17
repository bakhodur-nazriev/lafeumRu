import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./components/frontend/Home";
import Projects from "./components/frontend/Projects";
import Team from "./components/frontend/Team";
import Publications from "./components/frontend/Publications";
import Profile from "./components/frontend/Profile";
import Quotes from "./components/frontend/Quotes";
import Authors from "./components/admin/Authors";
import Photos from "./components/frontend/Photos";
import Terms from "./components/admin/Terms";
import KnowledgeAreas from "./components/frontend/KnowledgeAreas";
import Videos from "./components/frontend/Videos";
import Channels from "./components/frontend/Channels";

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
            path: "/dashboard/knowledge-areas",
            name: "/dashboard/knowledge-areas",
            component: KnowledgeAreas
        },
        {
            path: "/dashboard/videos",
            name: "/dashboard/videos",
            component: Videos
        },
        {
            path: "/dashboard/channels",
            name: "/dashboard/channels",
            component: Channels
        }
    ]
});
