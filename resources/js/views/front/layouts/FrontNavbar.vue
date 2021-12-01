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

            <v-row justify="center" class="hidden-xs-only ma-0" style="min-height: 75px;">
                <v-col class="d-flex align-items-center py-0 px-8" xl="9">
                    <v-col class="d-flex h-100 align-items-center pa-0">
                        <v-btn
                            text
                            plain
                            :key="i"
                            :href="item.href"
                            v-for="(item, i) in navItems"
                            class="text-decoration-none px-2"
                        >
                            <v-img
                                v-if="item.imageUrl"
                                :src="item.imageUrl"
                                max-width="72"
                                class="h-100"
                            />
                            <span v-else>{{ item.title }}</span>
                        </v-btn>
                    </v-col>
                    <v-spacer></v-spacer>
                    <v-col class="d-flex pa-0" v-if="!user">
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
                    </v-col>
                    <v-col class="d-flex justify-content-end align-items-center pa-0" v-else>
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
