import Quotes from "./components/admin/Quotes";
import Authors from "./components/admin/Authors";
import Terms from "./components/admin/Terms";
import Videos from "./components/admin/Videos";
import Photos from "./components/admin/Photos";
import Users from "./components/admin/Users"
import Profile from "./components/admin/Profile";
import Favorite from "./components/admin/Favourites";
/*import Channels from "./components/admin/Channels";
import KnowledgeAreas from "./components/admin/KnowledgeAreas";
import Vocabulary from "./components/admin/Vocabulary";
import Settings from "./components/admin/Settings";
import Chat from "./components/admin/Chat";*/

export const sidebarRoutes = [
    {
        meta: {
            icon: "mdi-plus",
            title: "Все записи",
        },
        path: "",
        subLinks: [
            {
                path: "/dashboard/quotes",
                name: "/dashboard/quotes",
                meta: {
                    icon: "mdi-plus",
                    title: "Цитаты"
                },
                component: Quotes
            },
            {
                meta: {
                    icon: "mdi-person",
                    title: "Авторы",
                },
                path: "/dashboard/authors",
                name: "/dashboard/authors",
                component: Authors
            },
            {
                meta: {
                    icon: "mdi-tag",
                    title: "Термины",
                },
                path: "/dashboard/terms",
                name: "/dashboard/terms",
                component: Terms
            },
            {
                meta: {
                    icon: "mdi-youtube",
                    title: "Видео",
                },
                path: "/dashboard/videos",
                name: "/dashboard/videos",
                component: Videos
            },
            {
                meta: {
                    icon: "mdi-image",
                    title: "Фото",
                },
                path: "/dashboard/photos",
                name: "/dashboard/photos",
                component: Photos
            },
        ]
    },
    /*{
        meta: {
            icon: "mdi-plus",
            title: "Все категории",
        },
        path: "",
        subLinks: [
            {
                path: "/dashboard/quotes",
                name: "/dashboard/quotes",
                meta: {
                    icon: "mdi-quote",
                    title: "Категория цитаты",
                },
                path: "/dashboard/terms",
                name: "/dashboard/terms",
                meta: {
                    icon: "mdi-",
                    title: "Категория термини",
                },
                path: "dashboard/vocabulary",
                name: "/dashboard/vocabulary",
                meta: {
                    icon: "mdi-",
                    title: "Категория словары",
                },
                path: "/dashboard/videos",
                name: "/dashboard/videos",
                meta: {
                    icon: "mdi-",
                    title: "Категория видео",
                },
            },
        ]
    },*/
    {
        meta: {
            icon: "mdi-account-group",
            title: "Все пользователи"
        },
        path: "/dashboard/users",
        name: "/dashboard/users",
        component: Users
    },
    {
        meta: {
            icon: "mdi-account",
            title: "Профиль",
        },
        path: "/dashboard/profile",
        name: "/dashboard/profile",
        component: Profile
    },
    {
        meta: {
            icon: "mdi-star",
            title: "Избранный",
        },
        path: "/dashboard/favorite",
        name: "/dashboard/favorite",
        component: Favorite
    },
    /*{
        meta: {
            icon: "mdi-settings",
            title: "Настройки",
        },
        name: "/dashboard/setting",
        path: "/dashboard/setting",
        component: Settings
    },*/
    /*{
        meta: {
            icon: "mdi-chat",
            title: "Чат",
        },
        path: "/dashboard/chat",
        component: Chat
    }*/
];

export default [...sidebarRoutes, ...sidebarRoutes[0].subLinks];
