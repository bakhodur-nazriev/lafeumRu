<template>
    <v-container>
        <!-- Header -->
        <v-row justify="center" class="my-1">
            <v-col class="px-1 col-lg-10 col-xl-10">
                <h5 class="text-uppercase font-weight-regular mb-0">Профил</h5>
            </v-col>
        </v-row>

        <v-row class="mt-0 mb-3">
            <!-- SideBar -->
            <v-col class="col-lg-3">
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

                            <v-tooltip top>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                        fab
                                        dark
                                        x-small
                                        color="primary"
                                        class="position-absolute"
                                        style="right: 37px; top: 137px;"
                                        v-bind="attrs"
                                        v-on="on"
                                    >
                                        <v-icon small dark>
                                            mdi-camera
                                        </v-icon>
                                    </v-btn>
                                </template>
                                <span>Изменить аватарку</span>
                            </v-tooltip>
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
            </v-col>

            <!-- Profile -->
            <profile :user-data="user"></profile>
        </v-row>
    </v-container>
</template>

<script>
import Profile from "./Profile";

export default {
    components: {Profile},
    name: "MainProfilePage",
    data() {
        return {
            csrf: window.Laravel.csrf_token,
            user: window.Laravel.auth,
            selectedItem: 0,
            items: [
                {text: "Профил", icon: "mdi-account-circle"},
                {text: "Избранное", icon: "mdi-briefcase"},
                {text: "Настроки", icon: "mdi-settings"},
                {text: "Выход", icon: "mdi-logout"},
            ],
        }
    }
}
</script>

<style scoped>

</style>
