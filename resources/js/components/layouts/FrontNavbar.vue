<template>
    <div class="">
        <v-app-bar
            color="primary accent-4"
            prominent
            height="84"
            dark
        >
            <v-app-bar-nav-icon
                @click.stop="drawer = !drawer"
                class="hidden-sm-and-up pt-6 pl-3"
            ></v-app-bar-nav-icon>

            <v-row justify="center" class="align-content-center h-100 hidden-xs-only">
                <v-col xl="9" lg="10" md="10" class="d-flex justify-content-between py-0 h-100 px-0">
                    <div class="d-flex align-items-center">
                        <div
                            v-for="item in items"
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
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
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
            items: [
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
