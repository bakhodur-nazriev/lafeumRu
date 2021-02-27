<template>
    <v-app-bar
        app
        flat
        height="84"
        class="primary"
    >
        <v-col cols="12" class="d-flex justify-content-around">
            <div class="d-flex align-items-center">
                <a
                    class="navbar-links mx-3 "
                    v-for="link in links"
                    :href="link.href"
                    :key="link"
                >
                    {{ link.name }}
                </a>
            </div>
            <div>
                <div class="text-center">
                    <v-avatar>
                        <img
                            src="https://cdn.vuetifyjs.com/images/john.jpg"
                            alt="John"
                        >
                    </v-avatar>
                    <v-menu offset-y left>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                dark
                                icon
                                v-on="on"
                                color="white"
                                v-bind="attrs"
                            >
                                <v-icon>
                                    mdi-chevron-down
                                </v-icon>
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item
                                v-for="(item, index) in items"
                                :key="index"
                            >
                                <v-list-item-title>{{ item.title }}</v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </div>
            </div>
        </v-col>
    </v-app-bar>
</template>

<script>
export default {
    name: "FrontNavbar",
    data() {
        return {
            items: [
                {title: 'Профил'},
                {title: 'Выход'},
            ],
            links: [
                {
                    name: "Главная",
                    href: "/"
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
    }
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

</style>
