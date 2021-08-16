<template>
    <div>
        <v-app-bar
            color="primary accent-4"
            height="84"
            prominent
            dark
            flat
        >
            <v-row class="hidden-sm-and-up h-100">
                <v-col class="pa-0 d-flex align-items-center">
                    <v-col class="d-flex justify-center pa-0 col-2">
                        <v-app-bar-nav-icon
                            @click.stop="drawer = !drawer"
                            class=""
                        ></v-app-bar-nav-icon>
                    </v-col>
                    <v-col class="d-flex justify-center col-8 pa-0">
                        <a
                            class="text-white subtitle-1 pr-2 text-decoration-none font-weight-medium"
                            :href="navItems[0].href">Главная</a>
                        <a
                            class="text-white subtitle-1 pl-2 text-decoration-none font-weight-medium"
                            :href="navItems[1].href">Область
                            знаний</a>
                    </v-col>
                </v-col>
            </v-row>

            <v-row justify="center" class="align-content-center h-100 hidden-xs-only mt-0">
                <v-col xl="9" lg="8" class="d-flex justify-content-between py-0 h-100 px-0">
                    <div class="d-flex align-items-center">
                        <div
                            v-for="item in navItems"
                            :key="item.href"
                        >
                            <a :href="item.href" class="navbar-links mx-3">
                                <span v-if="item.title">{{ item.title }}</span>
                                <v-img v-else width="71" class="mr-5" :src="item.imageUrl"></v-img>
                            </a>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-app-bar>

        <v-navigation-drawer
            v-model="drawer"
            temporary
            absolute
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
                        class="mb-0"
                    >
                        <v-list-item-icon>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title>{{ item.title }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
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
                    href: "",
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
                    icon: "mdi-home"
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
}

.navbar-links:hover {
    text-decoration: none;
    color: #A4C2FF;
}

button:focus {
    outline: none;
}

</style>
