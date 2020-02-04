<!--<template>-->
<!--    <nav>-->
<!--        <v-app-bar app color="grey&#45;&#45;text white" flat>-->
<!--            <v-app-bar-nav-icon @click.stop="drawer = !drawer"/>-->
<!--            <v-toolbar-title-->
<!--                class="text-uppercase grey&#45;&#45;text"-->
<!--                v-for="link in links"-->
<!--                :key="link.text"-->
<!--            >-->
<!--                <span>{{ link.text }}</span>-->
<!--            </v-toolbar-title>-->
<!--            <v-spacer></v-spacer>-->
<!--            <v-btn icon>-->
<!--                <v-icon>mdi-bell</v-icon>-->
<!--            </v-btn>-->
<!--            <v-menu offset-y>-->
<!--                <template v-slot:activator="{ on }">-->
<!--                    <v-btn class="grey&#45;&#45;text" text v-on="on">-->
<!--                        <v-icon left>mdi-chevron-down</v-icon>-->
<!--                        <span>Menu</span>-->
<!--                    </v-btn>-->
<!--                </template>-->
<!--                <v-list>-->
<!--                    <v-list-item-->
<!--                        v-for="link in links"-->
<!--                        :key="link.text"-->
<!--                        router-->
<!--                        :to="link.route"-->
<!--                    >-->
<!--                        <v-list-item-title>{{ link.text }}</v-list-item-title>-->
<!--                    </v-list-item>-->
<!--                </v-list>-->
<!--            </v-menu>-->
<!--            &lt;!&ndash; dropdown menu &ndash;&gt;-->
<!--            <v-btn text dark color="grey" @click="$refs.logoutform.submit()">-->
<!--                <span>Выход</span>-->
<!--                <v-icon right>mdi-exit-to-app</v-icon>-->
<!--            </v-btn>-->
<!--            <form-->
<!--                ref="logoutform"-->
<!--                action="/logout"-->
<!--                method="POST"-->
<!--                style="display: none;"-->
<!--            >-->
<!--                <input type="hidden" name="_token" :value="csrf"/>-->
<!--            </form>-->
<!--        </v-app-bar>-->
<!--        <v-navigation-drawer v-model="drawer" class="primary" app>-->
<!--            <v-layout column align-center>-->
<!--                <v-flex class="mt-5 text-center">-->
<!--                    <v-avatar size="130">-->
<!--                        <img :src="'/img/avatars/' + this.users.avatar" alt="John">-->
<!--                    </v-avatar>-->
<!--                    <h4 class="white&#45;&#45;text subheading mt-2">-->
<!--                        {{ this.users.name }}-->
<!--                    </h4>-->
<!--                </v-flex>-->
<!--            </v-layout>-->

<!--            <v-list dark shaped>-->
<!--                <div v-for="link in links" :key="link.text">-->
<!--                    <v-list-group-->
<!--                        :prepend-icon="link.icon"-->
<!--                        active-class="white&#45;&#45;text"-->
<!--                        no-action-->
<!--                    >-->
<!--                        <template v-slot:activator>-->
<!--                            <v-list-item-content>-->
<!--                                <v-list-item-title v-text="link.text"></v-list-item-title>-->
<!--                            </v-list-item-content>-->
<!--                        </template>-->

<!--                        <v-list-item-->
<!--                            v-for="(subLink, i) in link.links"-->
<!--                            :key="i"-->
<!--                            :to="subLink.route"-->
<!--                            router-->
<!--                            active-class="white&#45;&#45;text"-->
<!--                        >-->
<!--                            <v-list-item-content>-->
<!--                                <v-list-item-title v-text="subLink.text"></v-list-item-title>-->
<!--                            </v-list-item-content>-->
<!--                        </v-list-item>-->
<!--                    </v-list-group>-->
<!--                </div>-->
<!--            </v-list>-->
<!--        </v-navigation-drawer>-->
<!--    </nav>-->
<!--</template>-->
<template>
    <nav>
        <v-app-bar app color="grey&#45;&#45;text white" flat>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"/>
            <v-toolbar-title class="text-uppercase grey--text">
                <span>Lafeum</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>

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
                    <v-avatar size="130">
                        <img :src="'/img/avatars/' + this.users.avatar" alt="John">
                    </v-avatar>
                    <h4 class="white--text subheading mt-2">
                        {{ this.users.name }}
                    </h4>
                </v-flex>
            </v-layout>

            <v-list dark>
                <div v-for="link in links" :key="link.text">
                    <v-list-item v-if="!link.links" >
                        <v-list-item-icon>
                            <v-icon>{{ link.icon }}</v-icon>
                        </v-list-item-icon>

                        <v-list-item-title>{{ link.text }}</v-list-item-title>
                    </v-list-item>

                    <v-list-group
                        :prepend-icon="link.icon"
                        v-model="link.active"
                        active-class="white--text"
                        no-action
                        v-if="link.links"
                    >
                        <template v-slot:activator>
                            <v-list-item-content>
                                <v-list-item-title>{{ link.text }}</v-list-item-title>
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
                                <v-list-item-title v-text="subLink.text"/>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-group>
                </div>
            </v-list>
        </v-navigation-drawer>
    </nav>
</template>

<script>

    // let phpArray = "[\n";
    //
    // for(const item of allItems){
    //     phpArray += `'${item.innerText}',\n`;
    // }
    // phpArray += "]";
    // console.log(phpArray);

    export default {
        props: ["route"],
        data() {
            return {
                csrf: window.Laravel.csrf_token,
                users: window.Laravel.auth,
                drawer: true,
                currentLink: [],
                links: [
                    {
                        icon: "mdi-plus",
                        text: "Все записи",
                        links: [
                            {
                                icon: 'mdi-tag',
                                text: 'Цитаты',
                                route: '/dashboard/quotes'
                            },
                            {
                                icon: 'mdi-person',
                                text: 'Авторы',
                                route: '/dashboard/authors'
                            },
                            {
                                icon: 'mdi-tag',
                                text: 'Термины',
                                route: '/dashboard/terms'
                            },
                            {
                                icon: 'mdi-tag',
                                text: 'Области Знаний',
                                route: '/dashboard/knowledge-areas'
                            },
                            {
                                icon: 'mdi-youtube',
                                text: 'Видео',
                                route: '/dashboard/videos'
                            },
                            {
                                icon: 'mdi-youtube',
                                text: 'Каналы',
                                route: '/dashboard/channels'
                            },
                            {
                                icon: 'mdi-image',
                                text: 'Фото',
                                route: '/dashboard/photos'
                            },
                        ]
                    },
                    {icon: "mdi-folder", text: "My Projects", route: "/dashboard/projects"},
                    {icon: "mdi-account-group", text: "Пользователи", route: "/dashboard/users"},
                    {icon: "mdi-post", text: "Публикации", route: "/dashboard/publications"},
                    {icon: "mdi-account", text: "Профил", route: "/dashboard/profile"},
                    {icon: "mdi-settings", text: "Настройка", route: "/dashboard/setting"},
                    {icon: "mdi-chat", text: "Чат", route: "/dashboard/chat"}
                ]
            };
        },
        methods: {
            updateImage() {
                axios
                    .put('')
                    .then()
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
    };
</script>

<style>

</style>
