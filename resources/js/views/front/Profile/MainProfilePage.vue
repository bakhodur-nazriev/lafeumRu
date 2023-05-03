<template>
    <v-container>
        <v-row class="mt-0 mb-3" justify="center">
            <!-- SideBar for small display -->
            <v-col cols="12 hidden-md-and-up">
                <v-card
                    width="100%"
                    elevation="0"
                    class="rounded-lg pa-2"
                >
                    <v-card-actions class="d-flex align-items-center justify-content-between">
                        <v-btn
                            text
                            @click="selectedItem = 2"
                            class="mr-5 text-capitalize pl-0"
                        >
                            <v-icon color="grey">mdi-settings</v-icon>
                            Настройки
                        </v-btn>
                        <v-btn
                            color="primary"
                            class="text-capitalize"
                            @click="$refs.logout.submit()"
                        >
                            <v-icon class="mr-3">mdi-logout</v-icon>
                            Выход
                            <form ref="logout" action="/logout" method="POST" style="display: none;">
                                <input type="hidden" name="_token" :value="csrf"/>
                            </form>
                        </v-btn>
                    </v-card-actions>
                    <div class="d-flex mx-3 my-4">
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
                            <h5>{{ user.name }}</h5>
                            <h6>{{ user.email }}</h6>
                            <h6 v-if="user.age">{{ user.age }} {{ user.age <= 4 ? 'года' : 'лет' }}</h6>
                            <h6 v-if="user.gender">{{ user.gender === 'male' ? 'Мужчина' : 'Женщина' }}</h6>
                        </div>
                    </div>
                    <v-card-actions class="d-flex flex-column pl-0">
                        <div class="d-flex">
                            <v-btn
                                text
                                @click="selectedItem = 0"
                                class="mr-5 text-capitalize pl-0"
                                :class="{ 'text--primary': selectedItem === 0 }"
                            >
                                <v-icon color="grey">mdi-account</v-icon>
                                Мой профиль
                            </v-btn>
                            <v-btn
                                text
                                v-model="selectedItem"
                                @click="selectedItem = 1"
                                class="ml-5 text-capitalize"
                                :class="{ active: selectedItem === 1 }"
                            >
                                <v-icon color="grey">mdi-bookmark</v-icon>
                                Избранное
                            </v-btn>
                        </div>

                    </v-card-actions>
                </v-card>
            </v-col>

            <!-- SideBar for large display -->
            <div class="pa-3 hidden-sm-and-down">
                <v-card
                    tile
                    width="270"
                    elevation="0"
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
                            <v-list-item v-for="(item, i) in items" :key="i">
                                <v-list-item-icon>
                                    <v-icon v-text="item.icon"></v-icon>
                                </v-list-item-icon>

                                <v-list-item-content>
                                    <v-list-item-title v-text="item.text"></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>

                            <v-btn
                                block
                                elevation="0"
                                color="primary"
                                class="text-capitalize"
                                @click="$refs.logout.submit()"
                            >
                                Выход
                            </v-btn>

                            <form
                                ref="logout"
                                action="/logout"
                                method="POST"
                                style="display: none;"
                            >
                                <input type="hidden" name="_token" :value="csrf"/>
                            </form>
                        </v-list-item-group>
                    </v-list>
                </v-card>
            </div>

            <profile :user-data="user" v-if="selectedItem === 0"></profile>

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
            ],
        }
    },
}
</script>

<style scoped>

</style>
