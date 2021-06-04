<template>
    <v-app-bar
        flat
        height="84"
        class="primary"
    >
        <v-row justify="center" class="align-content-center h-100">
            <v-col lg="9" xl="9" class="d-flex justify-content-between py-0 h-100">
                <div class="d-flex align-items-center">
                    <div
                        v-for="link in links"
                        :key="link.href"
                    >
                        <a :href="link.href" class="navbar-links mx-4">
                            <span v-if="link.name">{{ link.name }}</span>
                            <v-img v-else width="71" class="mr-5" src="/img/lafeum-ru-home.png"></v-img>
                        </a>
                    </div>
                </div>

                <!--                    <div class="d-flex align-items-center">
                                        <v-btn
                                            color="white primary&#45;&#45;text"
                                            @click="$refs.logout.submit()"
                                            class="text-capitalize rounded-lg text-decoration-none primary"
                                            elevation="0"
                                            width="88"
                                        >
                                            выход
                                        </v-btn>

                                        <form
                                            ref="logout"
                                            action="/logout"
                                            method="POST"
                                            style="display: none;"
                                        >
                                            <input type="hidden" name="_token" :value="csrf"/>
                                        </form>
                                    </div>-->
                <!--                    <div class="d-flex align-items-center">
                                        <v-avatar>
                                            <img :src="user.avatar">
                                        </v-avatar>
                                        <v-menu offset-y left min-width="240" rounded="lg" nudge-bottom="20">
                                            <template v-slot:activator="{ on }">
                                                <v-btn
                                                    icon
                                                    v-on="on"
                                                    color="white"
                                                >
                                                    <v-icon>
                                                        mdi-menu-down
                                                    </v-icon>
                                                </v-btn>
                                            </template>
                                            <v-list>
                                                <v-list-item
                                                    v-for="profileLink in profileLinks"
                                                    :key="profileLink.href"
                                                >
                                                    <v-list-item-title class=" px-3 py-5">
                                                        <v-icon color="grey lighten-1" class="mr-6">
                                                            {{ profileLink.icon }}
                                                        </v-icon>
                                                        <a class="navbar-profile-links" :href="profileLink.href">
                                                            {{ profileLink.title }}
                                                        </a>
                                                    </v-list-item-title>
                                                </v-list-item>
                                            </v-list>
                                        </v-menu>
                                    </div>-->
            </v-col>
        </v-row>
    </v-app-bar>
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
            links: [
                {
                    imageUrl: "/img/lafeum-ru-home.png",
                    href: "/",
                },
                {
                    name: "Области Знаний",
                    href: "/knowledge",
                },
                {
                    name: "Словарь",
                    href: "/vocabulary"
                },
                {
                    name: "Цитаты",
                    href: "/quotes"
                },
                {
                    name: "Авторы",
                    href: "/authors"
                },
                {
                    name: "Видео",
                    href: "/videos"
                },
                {
                    name: "Каналы",
                    href: "/channels"
                },
                {
                    name: "Термины",
                    href: "/terms"
                },
                {
                    name: "Фотографии",
                    href: "/photos"
                },
            ]
        }
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

.navbar-profile-links {
    text-decoration: none;
    color: #676767;
}

.navbar-profile-links:hover {
    color: #1a718c;
}

button:focus {
    outline: none;
}

</style>
