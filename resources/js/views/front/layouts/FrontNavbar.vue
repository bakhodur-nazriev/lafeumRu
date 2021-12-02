<template>
    <div>
        <v-app-bar
            dark
            flat
            prominent
            height="85"
            color="primary accent-4"
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

            <v-row class="hidden-xs-only ma-0">
                <v-col cols="12" class="d-flex pa-0">
                    <v-col class="d-flex justify-content-center py-0">
                        <v-col
                            xl="9"
                            lg="10"
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
                        </v-col>
                    </v-col>
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

