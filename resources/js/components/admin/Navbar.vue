<template>
    <nav>
        <v-app-bar app color="grey&#45;&#45;text white" flat>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"/>
            <v-toolbar-title class="text-uppercase grey--text">
                <span>{{$route.meta.title}}</span>
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
                        <img :src="'/img/avatars/' + this.users.avatar" alt=""/>
                    </v-avatar>
                    <h4 class="white--text subheading mt-2">
                        {{ this.users.name }}
                    </h4>
                </v-flex>
            </v-layout>

            <v-list dark>
                <div v-for="link in links" :key="link.meta.title">
                    <v-list-group
                        :prepend-icon="link.meta.icon"
                        v-model="link.active"
                        active-class="white--text"
                        v-if="link.subLinks"
                        no-action
                    >
                        <template v-slot:activator>
                            <v-list-item-content>
                                <v-list-item-title>{{ link.meta.title }}</v-list-item-title>
                            </v-list-item-content>
                        </template>
                        <v-list-item
                            v-for="(subLink, i) in link.subLinks"
                            :key="i"
                            :to="subLink.path"
                            class="text-decoration-none"
                            active-class="white--text"
                            :prepend-icon="subLink.meta.icon"
                        >
                            <v-list-item-content>
                                <v-list-item-title v-text="subLink.meta.title"/>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-group>

                    <v-list-item
                        :to="link.path"
                        class="text-decoration-none"
                        active-class="white--text"
                        v-else
                    >
                        <v-list-item-icon>
                            <v-icon>{{ link.meta.icon }}</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="link.meta.title"/>
                        </v-list-item-content>
                    </v-list-item>
                </div>
            </v-list>
        </v-navigation-drawer>
    </nav>
</template>

<script>
    import {sidebarRoutes} from "../../routes";

    export default {
        data() {
            return {
                csrf: window.Laravel.csrf_token,
                users: window.Laravel.auth,
                drawer: true,
                currentLink: [],
                links: sidebarRoutes,
                avatarToUpdate: null
            };
        },
        mounted() {
            console.log(this.users);
        },
        methods: {
            updateAvatar() {
                const formData = new FormData();
                formData.append("avatar", this.avatarToUpdate.avatar);
                axios
                    .post("/api/users/" + this.avatarToUpdate.id, formData, {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(res => {
                        this.users();
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        }
    };
</script>
