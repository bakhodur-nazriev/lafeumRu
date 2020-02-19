import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./components/admin/Home";
import Profile from "./components/admin/Profile";
import Quotes from "./components/admin/Quotes";
import Authors from "./components/admin/Authors";
import Photos from "./components/admin/Photos";
import Terms from "./components/admin/Terms";
import KnowledgeAreas from "./components/admin/KnowledgeAreas";
import Videos from "./components/admin/Videos";
import Channels from "./components/admin/Channels";

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
