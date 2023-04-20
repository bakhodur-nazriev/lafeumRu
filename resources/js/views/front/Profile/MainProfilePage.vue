<template>
    <v-container>
        <v-row class="mt-0 mb-3" justify="center">
            <!-- Small SideBar -->
            <v-col class="pa-3 hidden-md-and-up">
                <v-card
                    tile
                    elevation="0"
                    height="100%"
                    class="mx-auto rounded-lg pa-4"
                >
                    <div class="d-flex align-items-center justify-content-between mb-6">
                        <a href="#" class="text-subtitle-1 grey--text text--darken-2">
                            <v-icon>mdi-settings</v-icon>
                            Настройки
                        </a>
                        <v-btn color="primary" class="text-capitalize" @click="$refs.logout.submit()">
                            <v-icon class="mr-3">mdi-logout</v-icon>
                            Выход
                            <form
                                ref="logout"
                                action="/logout"
                                method="POST"
                                style="display: none;"
                            >
                                <input type="hidden" name="_token" :value="csrf"/>
                            </form>
                        </v-btn>
                    </div>
                    <div class="d-flex mb-6">
                        <div class="mr-7">
                            <v-img
                                class="rounded-lg"
                                max-height="140"
                                max-width="140"
                                :src="user.avatar"
                                :alt="user.name"
                            ></v-img>
                        </div>
                        <div>
                            <h5>Bakhodur Nazriev</h5>
                            <h6>admin@gmail.com</h6>
                            <h6>29.29.1980</h6>
                            <h6>Мужчина</h6>
                        </div>
                    </div>
                    <div>
                        <a
                            href="#"
                            class="text-subtitle-1 mr-6 grey--text text--darken-2 text-decoration-none"
                        >
                            <v-icon :class="{ 'primary--text': true }">mdi-account</v-icon>
                            <span :class="{ 'primary--text': true }">Мой профиль</span>
                        </a>
                        <a
                            href="#"
                            class="text-subtitle-1 primary--text text--darken-2 font-weight-normal text-decoration-none"
                        >
                            <v-icon>mdi-bookmark</v-icon>
                            <span>Избранное</span>
                        </a>
                    </div>
                </v-card>
            </v-col>

            <!-- SideBar -->
            <div class="pa-3 hidden-sm-and-down">
                <v-card
                    tile
                    elevation="0"
                    width="270"
                    class="mx-auto rounded-lg"
                >
                    <v-list>
                        <v-list-item class="justify-content-center pa-4 pb-0">
                            <div class="bg-secondary pa-1 rounded-circle">
                                <v-list-item-avatar size="180" class="ma-0">
                                    <v-img :src="user.avatar" :alt="user.name"></v-img>
                                </v-list-item-avatar>
                            </div>

                        </v-list-item>

                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title class="d-flex justify-center text-h6">
                                    {{ user.name }}
                                </v-list-item-title>
                                <v-list-item-subtitle class="d-flex justify-center">
                                    {{ user.email }}
                                </v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>

                    <v-divider class="mt-2"></v-divider>

                    <v-list nav dense>
                        <v-list-item-group
                            v-model="selectedItem"
                            color="primary"
                        >
                            <v-list-item
                                v-for="(item, i) in items"
                                :key="i"
                            >
                                <v-list-item-icon>
                                    <v-icon v-text="item.icon"></v-icon>
                                </v-list-item-icon>

                                <v-list-item-content>
                                    <v-list-item-title v-text="item.text"></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-card>
            </div>

            <!-- Profile -->
            <profile :user-data="user" v-if="selectedItem === 0"></profile>

            <!-- Favourite -->
            <favourite v-if="selectedItem === 1"></favourite>
        </v-row>
    </v-container>
</template>

<script>
import Profile from "./Profile";
import Favourite from "./Favorite.vue";

export default {
    components: {Profile, Favourite},
    name: "MainProfilePage",
    data() {
        return {
            csrf: window.Laravel.csrf_token,
            user: window.Laravel.auth,
            selectedItem: 0,
            file: null,
            items: [
                {id: 0, text: "Профиль", icon: "mdi-account-circle"},
                {id: 1, text: "Избранное", icon: "mdi-briefcase"},
                {id: 2, text: "Настройки", icon: "mdi-settings"},
                {id: 3, text: "Выход", icon: "mdi-logout"},
            ],
        }
    },
}
</script>

<style scoped>

</style>
