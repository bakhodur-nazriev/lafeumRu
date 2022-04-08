/* Import Front components */
// import Home from "./views/front/Home";
// import KnowledgeArea from "./views/front/KnowledgeArea";
// import Vocabulary from "./views/front/Vocabulary";
// import Quotes from "./views/front/Quotes";
// import Authors from "./views/front/Authors";
// import Videos from "./views/front/Videos";
// import Channels from "./views/front/Channels";
// import Terms from "./views/front/Terms";
// import Photos from "./views/front/Photos";

/* Import Front Profile components */
import EditProfile from "./views/front/layouts/profile/EditProfile";
import FavouriteProfile from "./views/front/layouts/profile/FavouriteProfile";

/* Import Back components */
import QuotesPage from "./views/back/Quotes/QuotesPage";
import QuotesTrashedPage from "./views/back/Trashes/QuotesTrashedPage";
import TermsPage from "./views/back/Terms/TermsPage";
import TermsTrashedPage from "./views/back/Trashes/TermsTrashedPage";
import VideosPage from "./views/back/Videos/VideosPage";
import VideosTrashedPage from "./views/back/Trashes/VideosTrashedPage";
import PhotosPage from "./views/back/Photos/PhotosPage";
import PhotosTrashedPage from "./views/back/Trashes/PhotosTrashedPage";
import AuthorsPage from "./views/back/Authors/AuthorsPage";
import AuthorsTrashedPage from "./views/back/Trashes/AuthorsTrashedPage";
import UsersPage from "./views/back/Users/UsersPage";
import ProfilePage from "./views/back/Profile/ProfilePage";
import CategoriesPage from "./views/back/Categories/CategoriesPage";
import ChannelsPage from "./views/back/Channels/ChannelsPage";
import ChannelsTrashedPage from "./views/back/Trashes/ChannelsTrashedPage";
import KnowledgeAreasPage from "./views/back/KnowledgeAreas/KnowledgeAreasPage";
import FeedbacksPage from "./views/back/Feedback/FeedbacksPage";
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
        path: "/dashboard/channels",
        name: "/dashboard/channels",
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
            icon: "mdi-comment-quote",
            title: "Обратная связь",
            authorize: [role.admin, role.author]
        },
        name: "/dashboard/feedbacks",
        path: "/dashboard/feedbacks",
        component: FeedbacksPage
    }
];

let profileRoutes = [
    {
        path: "/profile/edit",
        name: "/profile/edit",
        component: EditProfile
    },
    {
        path: "/profile/favourite",
        name: "/profile/favourite",
        component: FavouriteProfile
    },

];

/* let allFrontRoutes = [
     {
         imageUrl: "/img/lafeum-ru-home.png",
         path: "/",
         component: Home
     },
     {
         name: "Области Знаний",
         path: "/knowledge",
         component: KnowledgeArea
     },
     {
         name: "Словарь",
         path: "/vocabulary",
         component: Vocabulary
     },
     {
         name: "Цитаты",
         path: "/quotes",
         component: Quotes
     },
     {
         name: "Авторы",
         path: "/authors",
         component: Authors
     },
     {
         name: "Видео",
         path: "/videos",
         component: Videos
     },
     {
         name: "Каналы",
         path: "/channels",
         component: Channels
     },
     {
         name: "Термины",
         path: "/terms",
         component: Terms
     },
     {
         name: "Фотографии",
         path: "/photos",
         component: Photos
     },
]; */

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
