<template>
    <v-container>
        <v-row class="mt-0 mb-3" justify="center">
            <!-- SideBar -->
            <div class="pa-3">
                <v-card
                    tile
                    elevation="0"
                    max-width="256"
                    height="100%"
                    class="mx-auto rounded-lg"
                >
                    <v-list>
                        <v-list-item class="justify-content-center py-4">
                            <v-list-item-avatar size="180" class="ma-0">
                                <v-img class="bg-black" :src="user.avatar" :alt="user.name"></v-img>
                            </v-list-item-avatar>
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
import Favourite from "./Favourite";

export default {
    components: {Profile, Favourite},
    name: "MainProfilePage",
    data() {
        return {
            csrf: window.Laravel.csrf_token,
            user: window.Laravel.auth,
            selectedItem: 1,
            items: [
                {id: 0, text: "Профил", icon: "mdi-account-circle"},
                {id: 1, text: "Избранное", icon: "mdi-briefcase"},
                {id: 2, text: "Настроки", icon: "mdi-settings"},
                {id: 3, text: "Выход", icon: "mdi-logout"},
            ],
        }
    },
}
</script>

<style scoped>

</style>
