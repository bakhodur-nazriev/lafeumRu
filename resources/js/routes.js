import QuotesPage from "./views/QuotesPage";
import AuthorsPage from "./views/AuthorsPage";
import TermsPage from "./views/TermsPage";
import VideosPage from "./views/VideosPage";
import PhotosPage from "./views/PhotosPage";
import UsersPage from "./views/UsersPage";
import ProfilePage from "./views/ProfilePage";
import FavouritesPage from "./views/FavouritesPage";
import CategoriesPage from "./views/CategoriesPage";
/*import Channels from "./views/Channels";
import KnowledgeAreas from "./views/KnowledgeAreas";
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
                component: QuotesPage
            },
            {
                meta: {
                    icon: "mdi-person",
                    title: "Авторы"
                },
                path: "/dashboard/authors",
                name: "/dashboard/authors",
                component: AuthorsPage
            },
            {
                meta: {
                    icon: "mdi-tag",
                    title: "Термины"
                },
                path: "/dashboard/terms",
                name: "/dashboard/terms",
                component: TermsPage
            },
            {
                meta: {
                    icon: "mdi-youtube",
                    title: "Видео"
                },
                path: "/dashboard/videos",
                name: "/dashboard/videos",
                component: VideosPage
            },
            {
                meta: {
                    icon: "mdi-image",
                    title: "Фото"
                },
                path: "/dashboard/photos",
                name: "/dashboard/photos",
                component: PhotosPage
            }
        ]
    },

    /* CategoriesPage Section */
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
                component: CategoriesPage
            },
            {
                meta: {
                    icon: "mdi-tag",
                    title: "Термины",
                    type: TERM_TYPE
                },
                path: "/dashboard/categories/terms",
                name: "/dashboard/categories/terms",
                component: CategoriesPage
            },
            {
                meta: {
                    icon: "mdi-youtube",
                    title: "Видео",
                    type: VIDEO_TYPE
                },
                path: "/dashboard/categories/videos",
                name: "/dashboard/categories/videos",
                component: CategoriesPage
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
        component: UsersPage
    },
    {
        meta: {
            icon: "mdi-account",
            title: "Профиль"
        },
        path: "/dashboard/profile",
        name: "/dashboard/profile",
        component: ProfilePage
    },
    {
        meta: {
            icon: "mdi-star",
            title: "Избранный"
        },
        path: "/dashboard/favorite",
        name: "/dashboard/favorite",
        component: FavouritesPage
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
