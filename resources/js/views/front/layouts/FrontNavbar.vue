<template>
    <div>
        <v-app-bar
            dark
            flat
            prominent
            color="primary accent-4"
            class="main-navbar-block"
            height="85"
        >
            <v-row class="hidden-sm-and-up h-100 ma-0">
                <v-col class="pa-0 d-flex align-center">
                    <v-col class="d-flex justify-center pa-0 col-2">
                        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                    </v-col>
                    <v-col class="d-flex justify-center col-8 pa-0">
                        <a
                            class="text-white subtitle-1 pr-2 text-decoration-none font-weight-medium text-uppercase"
                            :href="navItems[0].href"
                        >
                            Главная
                        </a>
                        <a
                            class="text-white subtitle-1 pl-2 text-decoration-none font-weight-medium text-uppercase"
                            :href="navItems[3].href"
                        >
                            Цитаты
                        </a>
                    </v-col>
                </v-col>
            </v-row>

            <v-row align="center" justify="center" class="hidden-xs-only ma-0">
                <v-col
                    lg="10"
                    class="d-lg-flex justify-content-between align-items-center d-md-block"
                    style="max-width: 1340px"
                >
                    <div class="d-flex justify-content-center align-items-end h-100 mb-sm-3">
                        <a
                            v-for="(item, i) in navItems"
                            :key="i"
                            :href="item.href"
                            class="navbar-links mx-2"
                        >
                            <v-img
                                v-if="item.imageUrl"
                                max-width="72"
                                :src="item.imageUrl"
                            >
                            </v-img>
                            <span v-else>{{ item.title }}</span>
                        </a>
                    </div>
                    <div class="d-flex justify-content-center pa-0" v-if="!user">
                        <v-btn
                            text
                            dark
                            href="login"
                            elevation="1"
                            class="text-capitalize rounded-lg white primary--text font-weight-bold mx-2 text-decoration-none"
                        >
                            <span>Вход</span>
                        </v-btn>

                        <v-btn
                            text
                            dark
                            elevation="1"
                            href="register"
                            class="text-capitalize rounded-lg white primary--text font-weight-bold ml-2 text-decoration-none"
                        >
                            <span>Регистрация</span>
                        </v-btn>
                    </div>

                    <div class="d-flex align-items-center" v-else>
                        <v-avatar>
                            <img :src="user.avatar">
                        </v-avatar>
                        <v-menu offset-y left min-width="240" rounded="lg" nudge-bottom="20">
                            <template v-slot:activator="{ on }">
                                <v-btn small icon v-on="on" color="white">
                                    <v-icon>mdi-menu-down</v-icon>
                                </v-btn>
                            </template>
                            <v-list>
                                <v-list-item
                                    v-for="profileLink in profileLinks"
                                    :key="profileLink.href"
                                >
                                    <v-list-item-title class="px-2 py-3">
                                        <v-icon color="grey darken-1" class="mr-4">
                                            {{ profileLink.icon }}
                                        </v-icon>
                                        <a
                                            class="primary--text"
                                            :href="profileLink.href"
                                        >
                                            {{ profileLink.title }}
                                        </a>
                                    </v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </div>
                </v-col>
            </v-row>
        </v-app-bar>

        <v-navigation-drawer
            v-model="drawer"
            temporary
            fixed
            left
        >
            <v-list nav dense>
                <v-list-item-group
                    v-model="group"
                    active-class="primary--text text--accent-4"
                >
                    <v-list-item
                        v-for="item in smallNavItems"
                        :key="item.href"
                        :href="item.href"
                        class="mb-0 text-decoration-none"
                    >
                        <v-list-item-icon>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>{{ item.title }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-col class="pa-0 small-nav-close-btn">
                        <v-btn
                            icon
                            @click.stop="drawer = !drawer"
                        >
                            <v-icon>{{ smallNavBtnClose }}</v-icon>
                        </v-btn>
                    </v-col>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>
    </div>
</template>

<script>
export default {
    name: "FrontNavbar",
    data() {
        return {
            csrf: window.Laravel.csrf_token,
            user: window.Laravel.auth,
            profileLinks: [
                {
                    title: "Мой Профил",
                    href: "/profile",
                    icon: "mdi-account-circle"
                },
                {
                    title: "Избранное",
                    href: "profile-favorites",
                    icon: "mdi-briefcase"
                },
                {
                    title: "Настройки",
                    href: "/",
                    icon: "mdi-tune"
                },
                {
                    title: "Выход",
                    href: "/logout",
                    icon: "mdi-logout"
                },
            ],
            navItems: [
                {
                    imageUrl: "/img/lafeum-ru-home.png",
                    href: "/",
                },
                {
                    title: "Области Знаний",
                    href: "/knowledge",
                },
                {
                    title: "Словарь",
                    href: "/vocabulary"
                },
                {
                    title: "Цитаты",
                    href: "/quotes"
                },
                {
                    title: "Авторы",
                    href: "/authors"
                },
                {
                    title: "Видео",
                    href: "/videos"
                },
                {
                    title: "Каналы",
                    href: "/channels"
                },
                {
                    title: "Термины",
                    href: "/terms"
                },
                {
                    title: "Фотографии",
                    href: "/photos"
                },
            ],
            smallNavItems: [
                {
                    title: "Главная",
                    href: "/",
                    icon: "mdi-home",
                },
                {
                    title: "Области Знаний",
                    href: "/knowledge",
                    icon: "mdi-bookshelf"
                },
                {
                    title: "Словарь",
                    href: "/vocabulary",
                    icon: "mdi-alphabet-cyrillic"
                },
                {
                    title: "Цитаты",
                    href: "/quotes",
                    icon: "mdi-format-quote-close"
                },
                {
                    title: "Авторы",
                    href: "/authors",
                    icon: "mdi-account-supervisor"
                },
                {
                    title: "Видео",
                    href: "/videos",
                    icon: "mdi-youtube"
                },
                {
                    title: "Каналы",
                    href: "/channels",
                    icon: "mdi-animation-play"
                },
                {
                    title: "Термины",
                    href: "/terms",
                    icon: "mdi-file-document"
                },
                {
                    title: "Фотографии",
                    href: "/photos",
                    icon: "mdi-camera"
                },
                {
                    title: "Логин",
                    href: "/login",
                    icon: "mdi-login-variant"
                }
            ],
            smallNavBtnClose: "mdi-close",
            drawer: false,
            group: null,
        }
    },
    watch: {
        group() {
            this.drawer = false
        },
    },
}
</script>

<style scoped>

@media (max-width: 1264px) {
    .main-navbar-block {
        height: 128px !important;
    }
}

@media (min-width: 1264px) {
    .main-navbar-block {
        height: 85px !important;
    }
}

@media (max-width: 600px) {
    .main-navbar-block {
        height: 85px !important;
    }
}

.navbar-links {
    font-size: 14px;
    font-weight: 500;
    color: #fff;
    line-height: 1;
    text-transform: uppercase;
}

.navbar-links:hover {
    text-decoration: none;
    color: #A4C2FF;
}

button:focus {
    outline: none;
}

.small-nav-close-btn {
    position: absolute;
    top: 0;
    right: 0;
    width: auto;
}

</style>

