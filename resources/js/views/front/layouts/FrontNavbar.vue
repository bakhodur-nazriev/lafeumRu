<template>
    <div class="primary accent-4">
        <v-container>
            <v-app-bar
                dark
                flat
                height="85"
                color="transparent"
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

                <v-row class="d-none h-100 ma-0 medium-nav-size">
                    <v-col class="pa-0 d-flex align-center">
                        <v-col class="d-flex justify-center align-center col-12 pa-0">
                            <div class="d-flex justify-center align-center pa-0 mr-8">
                                <a
                                    class="text-white subtitle-1 text-decoration-none font-weight-medium text-uppercase"
                                    :href="navItems[0].href"
                                >
                                    <v-img
                                        max-width="72"
                                        :src="navItems[0].imageUrl"
                                    >
                                    </v-img>
                                </a>
                                <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                            </div>

                            <div class="d-flex align-center">
                                <a
                                    class="text-white body-1 text-decoration-none text-uppercase px-2"
                                    :href="navItems[3].href"
                                >
                                    {{ navItems[3].title }}
                                </a>
                                <a
                                    class="text-white body-1 text-decoration-none text-uppercase px-2"
                                    :href="navItems[2].href"
                                >
                                    {{ navItems[2].title }}
                                </a>
                                <a
                                    class="text-white body-1 text-decoration-none text-uppercase px-2"
                                    :href="navItems[7].href"
                                >
                                    {{ navItems[7].title }}
                                </a>
                                <a
                                    class="text-white body-1 text-decoration-none text-uppercase px-2"
                                    :href="navItems[5].href"
                                >
                                    {{ navItems[5].title }}
                                </a>
                            </div>
                        </v-col>
                    </v-col>
                </v-row>

                <v-row class="hidden-md-and-down  ma-0">
                    <div class="d-flex justify-content-center w-100">
                        <v-col class="d-flex justify-space-between pa-0" style="max-width: 1350px;">
                            <div
                                class="d-flex justify-content-center align-items-center pa-3"
                                style="min-height: 75px;"
                            >
                                <div
                                    class="d-flex align-items-end h-100 pa-0 mx-2"
                                    v-for="(item, i) in navItems"
                                    :key="i"
                                >
                                    <a
                                        class="navbar-links text-uppercase"
                                        :href="item.href"
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
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-start pa-0"
                                v-if="!user"
                            >
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
                                    class="text-capitalize rounded-lg white primary--text font-weight-bold mx-2 text-decoration-none"
                                >
                                    <span>Регистрация</span>
                                </v-btn>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-end pa-0"
                                v-else
                            >
                                <v-avatar>
                                    <img :src="user.avatar" :alt="user.name">
                                </v-avatar>
                                <v-menu offset-y left min-width="200" rounded="lg" nudge-bottom="20">
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            icon
                                            small
                                            v-on="on"
                                            color="white"
                                        >
                                            <v-icon>mdi-menu-down</v-icon>
                                        </v-btn>
                                    </template>
                                    <v-list dense>
                                        <v-list-item
                                            v-for="profileLink in profileLinks"
                                            :key="profileLink.href"
                                            :href="profileLink.href"
                                            class="text-decoration-none font-weight-regular"
                                        >
                                            <v-list-item-icon class="mr-2">
                                                <v-icon v-text="profileLink.icon"></v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-content>
                                                <v-list-item-title class="pa-1 primary--text">
                                                    {{ profileLink.title }}
                                                </v-list-item-title>
                                            </v-list-item-content>
                                        </v-list-item>
                                        <v-list-item
                                            class="text-decoration-none font-weight-regular"
                                            @click="$refs.logout.submit()"
                                        >
                                            <v-list-item-icon class="mr-2">
                                                <v-icon>mdi-logout</v-icon>
                                            </v-list-item-icon>
                                            <v-list-item-content>
                                                <v-list-item-title class="pa-1 primary--text">
                                                    <span>Выход</span>
                                                    <form
                                                        ref="logout"
                                                        action="/logout"
                                                        method="POST"
                                                        style="display: none;"
                                                    >
                                                        <input type="hidden" name="_token" :value="csrf"/>
                                                    </form>
                                                </v-list-item-title>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-list>
                                </v-menu>
                            </div>
                        </v-col>
                    </div>
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
        </v-container>
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
                    icon: "mdi-settings"
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
@media (min-width: 600px) and (max-width: 1264px) {
    .medium-nav-size {
        display: flex !important;
    }
}

.navbar-links {
    font-size: 14px;
    font-weight: 500;
    color: #fff;
    line-height: 0.7;
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

