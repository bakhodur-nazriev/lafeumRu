import QuotesPage from "./views/Quotes/QuotesPage";
import QuotesTrashedPage from "./views/Trashes/QuotesTrashedPage";
import TermsPage from "./views/Terms/TermsPage";
import TermsTrashedPage from "./views/Trashes/TermsTrashedPage";
import VideosPage from "./views/Videos/VideosPage";
import VideosTrashedPage from "./views/Trashes/VideosTrashedPage";
import PhotosPage from "./views/Photos/PhotosPage";
import PhotosTrashedPage from "./views/Trashes/PhotosTrashedPage";
import AuthorsPage from "./views/Authors/AuthorsPage";
import AuthorsTrashedPage from "./views/Trashes/AuthorsTrashedPage";
import UsersPage from "./views/Users/UsersPage";
import ProfilePage from "./views/Profile/ProfilePage";
import CategoriesPage from "./views/Categories/CategoriesPage";
import ChannelsPage from "./views/Channels/ChannelsPage";
import ChannelsTrashedPage from "./views/Trashes/ChannelsTrashedPage";
import KnowledgeAreasPage from "./views/KnowledgeAreas/KnowledgeAreasPage";
import SettingsPage from "./views/SettingsPage";
import FeedbacksPage from "./views/Feedback/FeedbacksPage";
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
    /* Trashed Data Section */
    {
        meta: {
            icon: "mdi-delete",
            title: "Корзина",
            authorize: [role.author]
        },
        path: "",
        subLinks: [
            {
                meta: {
                    icon: "mdi-plus",
                    title: "Цитаты",
                    pageTitle: "Корзина Цитаты"
                },
                path: "/dashboard/quotes-trashed",
                name: "/dashboard/quotes-trashed",
                component: QuotesTrashedPage
            },
            {
                meta: {
                    icon: "mdi-tag",
                    title: "Термины",
                    pageTitle: "Корзина Термины"
                },
                path: "/dashboard/terms-trashed",
                name: "/dashboard/terms-trashed",
                component: TermsTrashedPage
            },
            {
                meta: {
                    icon: "mdi-youtube",
                    title: "Видео",
                    pageTitle: "Корзина Видео"
                },
                path: "/dashboard/videos-trashed",
                name: "/dashboard/videos-trashed",
                component: VideosTrashedPage
            },
            {
                meta: {
                    icon: "mdi-image",
                    title: "Фото",
                    pageTitle: "Корзина Фото"
                },
                path: "/dashboard/photos-trashed",
                name: "/dashboard/photos-trashed",
                component: PhotosTrashedPage
            },
            {
                meta: {
                    icon: "mdi-image",
                    title: "Авторы",
                    pageTitle: "Корзина Авторы",
                },
                path: "/dashboard/authors-trashed",
                name: "/dashboard/authors-trashed",
                component: AuthorsTrashedPage
            },
            {
                meta: {
                    icon: "mdi-image",
                    title: "Каналы",
                    pageTitle: "Корзина Каналы",
                },
                path: "/dashboard/channels-trashed",
                name: "/dashboard/channels-trashed",
                component: ChannelsTrashedPage
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
