<template>
    <nav>
        <v-app-bar app color="grey--text" flat>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"/>
            <v-toolbar-title class="text-uppercase grey--text">
                <span>lafeum</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn icon>
                <v-icon>mdi-bell</v-icon>
            </v-btn>

            <v-menu offset-y>
                <template v-slot:activator="{ on }">
                    <v-btn class="grey--text" text v-on="on">
                        <v-icon left>mdi-chevron-down</v-icon>
                        <span>Menu</span>
                    </v-btn>
                </template>
                <v-list>
                    <v-list-item
                        v-for="link in links"
                        :key="link.text"
                        router
                        :to="link.route"
                    >
                        <v-list-item-title>{{ link.text }}</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
            <!-- dropdown menu -->

            <v-btn text dark color="grey" @click="$refs.logoutform.submit()">
                <span>Выход</span>
                <v-icon right>mdi-exit-to-app</v-icon>
            </v-btn>

            <form
                ref="logoutform"
                action="/logout"
                method="POST"
                style="display: none;"
            >
                <input type="hidden" name="_token" :value="csrf"/>
            </form>
        </v-app-bar>

        <v-navigation-drawer v-model="drawer" class="primary" app>
            <v-layout column align-center>
                <v-flex class="mt-5 text-center">
                    <v-avatar size="110">
                        <!--                         <v-img src="{{ this.user.avatar }}"></v-img>-->
                    </v-avatar>
                    <p class="white--text subheading mt-1">
                        {{ this.users.name }}
                    </p>
                </v-flex>
            </v-layout>
            <!--            <v-list>-->
            <!--                <v-list-item-->
            <!--                    v-for="link in links"-->
            <!--                    :key="link.text"-->
            <!--                    :to="link.route"-->
            <!--                    router-->
            <!--                >-->
            <!--                    <v-list-item-icon>-->
            <!--                        <v-icon color="white" v-text="link.icon"></v-icon>-->
            <!--                    </v-list-item-icon>-->
            <!--                    <v-list-item-content class="white&#45;&#45;text">-->
            <!--                        <v-list-item-title v-text="link.text"></v-list-item-title>-->
            <!--                    </v-list-item-content>-->
            <!--                </v-list-item>-->
            <!--            </v-list>-->

            <v-list dark shaped>
                <div v-for="link in links" :key="link.text">
                    <v-list-group
                        v-model="link.active"
                        :prepend-icon="link.icon"
                        active-class="white--text"
                        no-action

                    >
                        <template v-slot:activator>
                            <v-list-item-content>
                                <v-list-item-title v-text="link.text"></v-list-item-title>
                            </v-list-item-content>
                        </template>

                        <v-list-item
                            v-for="(subLink, i) in link.links"
                            :key="i"
                            :to="subLink.route"
                            router

                            active-class="white--text"
                        >
                            <v-list-item-content>
                                <v-list-item-title v-text="subLink.text"></v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-group>
                </div>
            </v-list>
        </v-navigation-drawer>
    </nav>
</template>

<script>
    export default {
        props: ["route"],
        data() {
            return {
                csrf: window.Laravel.csrf_token,
                users: window.Laravel.auth,
                drawer: true,
                links: [
                    {
                        icon: "mdi-plus",
                        text: "Добавить запись",
                        // route: "/admin/record",
                        links: [
                            {
                                icon: 'mdi-tag',
                                text: 'Цитаты',
                                route: '/admin/quotes'
                            },
                            {
                                icon: 'mdi-person',
                                text: 'Авторы',
                                route: '/admin/authors'
                            },
                            {
                                icon: 'mdi-tag',
                                text: 'Термины',
                                route: '/admin/terms'
                            },
                            {
                                icon: 'mdi-tag',
                                text: 'Области Знаний',
                                route: '/admin/knowledge-areas'
                            },
                            {
                                icon: 'mdi-youtube',
                                text: 'Видео',
                                route: '/admin/videos'
                            },
                            {
                                icon: 'mdi-youtube',
                                text: 'Каналы',
                                route: '/admin/channels'
                            },
                            {
                                icon: 'mdi-image',
                                text: 'Фото',
                                route: '/admin/photos'
                            },
                        ]
                    },
                    {icon: "mdi-folder", text: "My Projects", route: "/admin/projects"},
                    {icon: "mdi-account-group", text: "Группа", route: "/admin/group"},
                    {icon: "mdi-post", text: "Публикации", route: "/admin/publications"},
                    {icon: "mdi-account", text: "Профил", route: "/admin/profile"},
                    {icon: "mdi-settings", text: "Настройка", route: "/admin/setting"},
                    {icon: "mdi-chat", text: "Чат", route: "/admin/chat"}
                ]
            };
        },
        method: {}
    };
</script>
