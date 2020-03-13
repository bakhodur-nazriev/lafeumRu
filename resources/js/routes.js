import Quotes from "./components/admin/Quotes";
import Authors from "./components/admin/Authors";
import Terms from "./components/admin/Terms";
import KnowledgeAreas from "./components/admin/KnowledgeAreas";
import Videos from "./components/admin/Videos";
import Channels from "./components/admin/Channels";
import Photos from "./components/admin/Photos";
import Users from "./components/admin/Users"
// import Vocabulary from "./components/admin/Vocabulary";
import Profile from "./components/admin/Profile";
import Favorite from "./components/admin/Favorite";
import Settings from "./components/admin/Settings";
import Chat from "./components/admin/Chat";

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
    {
        meta: {
            icon: "mdi-plus",
            title: "Все категории",
        },
        path: "",
        subLinks: [
            {
                path: "",
                name: "/dashboard/author",
                meta: {
                    icon: "mdi-",
                    title: "",
                }
            },
        ]
    },
    {
        meta: {
            icon: "mdi-account",
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
    {
        meta: {
            icon: "mdi-settings",
            title: "Настройки",
        },
        name: "/dashboard/setting",
        path: "/dashboard/setting",
        component: Settings
    },
    {
        meta: {
            icon: "mdi-chat",
            title: "Чат",
        },
        path: "/dashboard/chat",
        component: Chat
    }
];

export default [...sidebarRoutes, ...sidebarRoutes[0].subLinks];
