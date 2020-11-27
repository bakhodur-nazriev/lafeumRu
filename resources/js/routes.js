import QuotesPage from "./views/QuotesPage";
import QuotesTrashPage from "./views/Trashes/QuotesTrashPage";
import TermsPage from "./views/TermsPage";
import TermsTrashesPage from "./views/Trashes/TermsTrashesPage";
import VideosPage from "./views/VideosPage";
import VideosTrashesPage from "./views/Trashes/VideosTrashesPage";
import PhotosPage from "./views/PhotosPage";
import PhotosForceDeleteDialog from "./views/Trashes/PhotosTrashesPage";
import AuthorsPage from "./views/AuthorsPage";
import UsersPage from "./views/UsersPage";
import ProfilePage from "./views/ProfilePage";
import FavouritesPage from "./views/FavouritesPage";
import CategoriesPage from "./views/CategoriesPage";
import ChannelsPage from "./views/ChannelsPage";
import KnowledgeAreasPage from "./views/KnowledgeAreasPage";
import SettingsPage from "./views/SettingsPage";
import FeedbacksPage from "./views/FeedbacksPage";

// import Vocabulary from "./components/admin/Vocabulary";

import role from "./role";

require("../js/constants");

let allSidebarRoutes = [
    /* Posts Section */
    {
        meta: {
            icon: "mdi-plus",
            title: "Все записи",
            authorize: [role.author]
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
            title: "Категории",
            authorize: [role.author]
        },
        path: "",
        subLinks: [
            {
                path: "/dashboard/categories/quotes",
                name: "/dashboard/categories/quotes",
                meta: {
                    icon: "mdi-plus",
                    title: "Цитаты",
                    pageTitle: "Категории цитат",
                    type: QUOTE_TYPE
                },
                component: CategoriesPage
            },
            {
                meta: {
                    icon: "mdi-tag",
                    title: "Термины",
                    pageTitle: "Категории терминов",
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
                    pageTitle: "Категории видео",
                    type: VIDEO_TYPE
                },
                path: "/dashboard/categories/videos",
                name: "/dashboard/categories/videos",
                component: CategoriesPage
            }
        ]
    },
    /* Trashes Section */
    {
        meta: {
            icon: "mdi-delete",
            title: "Карзина",
            authorize: [role.author]
        },
        path: "",
        subLinks: [
            {
                path: "/dashboard/quotes-trashes",
                name: "/dashboard/quotes-trashes",
                meta: {
                    icon: "mdi-plus",
                    title: "Карзина Цитаты"
                },
                component: QuotesTrashPage
            },
            {
                meta: {
                    icon: "mdi-tag",
                    title: "Карзина Термины"
                },
                path: "/dashboard/terms-trashes",
                name: "/dashboard/terms-trashes",
                component: TermsTrashesPage
            },
            {
                meta: {
                    icon: "mdi-youtube",
                    title: "Карзина Видео"
                },
                path: "/dashboard/videos-trashes",
                name: "/dashboard/videos-trashes",
                component: VideosTrashesPage
            },
            {
                meta: {
                    icon: "mdi-image",
                    title: "Карзина Фото"
                },
                path: "/dashboard/photos-trashes",
                name: "/dashboard/photos-trashes",
                component: PhotosForceDeleteDialog
            }
        ]
    },
    {
        meta: {
            icon: "mdi-account-tie",
            title: "Авторы",
            authorize: [role.author]
        },
        path: "/dashboard/authors",
        name: "/dashboard/authors",
        component: AuthorsPage
    },
    {
        meta: {
            icon: "mdi-youtube-subscription",
            title: "Каналы",
            authorize: [role.author]
        },
        path: "/dashboard/сhannels",
        name: "/dashboard/сhannels",
        component: ChannelsPage
    },
    {
        meta: {
            icon: "mdi-bookshelf",
            title: "Области знаний",
            authorize: [role.author]
        },
        path: "/dashboard/knowledge",
        name: "/dashboard/knowledge",
        component: KnowledgeAreasPage
    },
    {
        meta: {
            icon: "mdi-account-group",
            title: "Все пользователи",
            authorize: [role.admin]
        },
        path: "/dashboard/users",
        name: "/dashboard/users",
        component: UsersPage
    },
    {
        meta: {
            icon: "mdi-account-cog",
            title: "Профиль",
            authorize: [role.author, role.member]
        },
        path: "/dashboard/profile",
        name: "/dashboard/profile",
        component: ProfilePage
    },
    {
        meta: {
            icon: "mdi-star",
            title: "Избранный",
            authorize: [role.author, role.member]
        },
        path: "/dashboard/favorite",
        name: "/dashboard/favorite",
        component: FavouritesPage
    },
    {
        meta: {
            icon: "mdi-settings",
            title: "Настройки сайта",
            authorize: [role.admin]
        },
        name: "/dashboard/setting",
        path: "/dashboard/setting",
        component: SettingsPage
    },
    {
        meta: {
            icon: "mdi-comment-quote",
            title: "Обратная связь",
            authorize: [role.admin, role.author]
        },
        name: "/dashboard/feedbacks",
        path: "/dashboard/feedbacks",
        component: FeedbacksPage
    }
];

function getAuthorizedRoutes(routes) {
    if (!Laravel.auth) {
        return [];
    }

    let currentRole = Laravel.auth.role_id;

    //Admin has access to all routes
    if (currentRole === role.admin) {
        return routes;
    }

    return routes.filter(r => r.meta.authorize.includes(currentRole));
}

export const sidebarRoutes = getAuthorizedRoutes(allSidebarRoutes);

function getAppRoutes() {
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

export default getAppRoutes();
