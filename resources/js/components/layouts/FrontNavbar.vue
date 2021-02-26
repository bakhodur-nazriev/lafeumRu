<template>
    <v-app-bar
        app
        flat
        height="84"
        class="bg-primary text-white"
    >
        <v-avatar size="32"></v-avatar>

        <v-tabs
            centered
            class="ml-n9"
            color="grey darken-1"
        >
            <v-tab
                v-for="link in links"
                :key="link"
                class="text-white"
            >
                    {{ link.name }}
            </v-tab>
        </v-tabs>

        <v-avatar
            class="hidden-sm-and-down"
            color="grey darken-1 shrink"
            size="32"
        ></v-avatar>
    </v-app-bar>
</template>

<script>
export default {
    name: "FrontNavbar",
    data() {
        return {
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

</style>
