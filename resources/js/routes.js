import Quotes from "./components/admin/Quotes";
import Authors from "./components/admin/Authors";
import Terms from "./components/admin/Terms";
import Videos from "./components/admin/Videos";
import Photos from "./components/admin/Photos";
import Users from "./components/admin/Users";
import Profile from "./components/admin/Profile";
import Favorite from "./components/admin/Favourites";
import Categories from "./components/admin/Categories";
/*import Channels from "./components/admin/Channels";
import KnowledgeAreas from "./components/admin/KnowledgeAreas";
import Vocabulary from "./components/admin/Vocabulary";
import Settings from "./components/admin/Settings";
import Chat from "./components/admin/Chat";*/
require('../js/constants');

export const sidebarRoutes = [
    /* Posts Section */
    {
        meta: {
            icon: "mdi-plus",
            title: "Все записи"
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
                    title: "Авторы"
                },
                path: "/dashboard/authors",
                name: "/dashboard/authors",
                component: Authors
            },
            {
                meta: {
                    icon: "mdi-tag",
                    title: "Термины"
                },
                path: "/dashboard/terms",
                name: "/dashboard/terms",
                component: Terms
            },
            {
                meta: {
                    icon: "mdi-youtube",
                    title: "Видео"
                },
                path: "/dashboard/videos",
                name: "/dashboard/videos",
                component: Videos
            },
            {
                meta: {
                    icon: "mdi-image",
                    title: "Фото"
                },
                path: "/dashboard/photos",
                name: "/dashboard/photos",
                component: Photos
            }
        ]
    },

    /* Categories Section */
    {
        meta: {
            icon: "mdi-format-list-bulleted",
            title: "Категории"
        },
        path: "",
        subLinks: [
            {
                path: "/dashboard/categories/quotes",
                name: "/dashboard/categories/quotes",
                meta: {
                    icon: "mdi-plus",
                    title: "Цитаты",
                    type: QUOTE_TYPE
                },
                component: Categories
            },
            {
                meta: {
                    icon: "mdi-tag",
                    title: "Термины",
                    type: TERM_TYPE
                },
                path: "/dashboard/categories/terms",
                name: "/dashboard/categories/terms",
                component: Categories
            },
            {
                meta: {
                    icon: "mdi-youtube",
                    title: "Видео",
                    type: VIDEO_TYPE
                },
                path: "/dashboard/categories/videos",
                name: "/dashboard/categories/videos",
                component: Categories
            }
        ]
    },
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
            title: "Профиль"
        },
        path: "/dashboard/profile",
        name: "/dashboard/profile",
        component: Profile
    },
    {
        meta: {
            icon: "mdi-star",
            title: "Избранный"
        },
        path: "/dashboard/favorite",
        name: "/dashboard/favorite",
        component: Favorite
    }
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

function flatSideBarRoutes() {
    let appRoutes = [];

    for (const route of sidebarRoutes) {
        if (route.subLinks) {
            for (const subLink of route.subLinks) {
                appRoutes.push(subLink);
            }
            continue;
        }

        appRoutes.push(route);
    }

    return appRoutes;
}

export default flatSideBarRoutes();
