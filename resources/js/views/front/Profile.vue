<template>
    <v-container>
        <!-- Header -->
        <v-row justify="center">
            <v-col class="px-1 col-lg-10 col-xl-9">
                <h5 class="text-uppercase font-weight-regular pb-3 mb-0">Профил</h5>
            </v-col>
        </v-row>

        <!-- Content -->
        <v-row class="justify-content-center">
            <v-col class="col-lg-3">
                <v-card
                    tile
                    elevation="0"
                    max-width="256"
                    class="mx-auto rounded-lg"
                >
                    <v-list>
                        <v-list-item class="justify-center">
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
                                        style="right: 50px; top: 137px"
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
            <v-col class="col-lg-8">
                <v-card
                    tile
                    width="800"
                    height="500"
                    elevation="0"
                    class="mx-auto rounded-lg pa-3"
                >
                    <v-col
                        md="10"
                        cols="12"
                    >
                        <div>
                            <h6 class="pa-1 grey--text mb-1">Полное имя пользователя*</h6>
                        </div>
                        <div class="d-flex">
                            <v-text-field
                                solo
                                flat
                                dense
                                single-line
                                hide-details
                                :label="user.name"
                                background-color="grey lighten-2"
                                class="mr-4 rounded-lg"
                                placeholder="Placeholder"
                            ></v-text-field>
                            <v-btn color="primary">Изменить</v-btn>
                        </div>
                    </v-col>
                    <v-col
                        md="10"
                        cols="12"
                    >
                        <div>
                            <h6 class="grey--text pa-1 mb-1">Адрес E-mail</h6>
                        </div>
                        <div class="d-flex">
                            <v-text-field
                                solo
                                flat
                                dense
                                hide-details
                                :label="user.email"
                                background-color="grey lighten-2"
                                class="mr-4 rounded-lg"
                                placeholder="Placeholder"
                            ></v-text-field>
                            <v-btn color="primary">Изменить</v-btn>
                        </div>
                    </v-col>
                    <v-col
                        md="10"
                        cols="12"
                    >
                        <div>
                            <h6 class="grey--text pa-1 mb-1">Пароль</h6>
                        </div>
                        <div class="d-flex">
                            <v-text-field
                                solo
                                flat
                                dense
                                hide-details
                                :label="user.password"
                                background-color="grey lighten-2"
                                class="mr-4 rounded-lg"
                                placeholder="Placeholder"
                            ></v-text-field>
                            <v-btn color="primary">Изменить</v-btn>
                        </div>
                    </v-col>
                    <!--                    <v-col-->
                    <!--                        cols="12"-->
                    <!--                        class="d-flex"-->
                    <!--                    >-->
                    <!--                        <div>-->
                    <!--                            <v-text-field-->
                    <!--                                solo-->
                    <!--                                dense-->
                    <!--                                hide-details-->
                    <!--                                type="number"-->
                    <!--                                :label="user.age"-->
                    <!--                                placeholder="Placeholder"-->
                    <!--                            ></v-text-field>-->
                    <!--                            <v-btn color="primary">Изменить</v-btn>-->
                    <!--                        </div>-->

                    <!--                        <div>-->
                    <!--                            <v-select-->
                    <!--                                solo-->
                    <!--                                dense-->
                    <!--                                class="mr-4"-->
                    <!--                                hide-details-->
                    <!--                                :label="user.gender"-->
                    <!--                            ></v-select>-->
                    <!--                            <v-btn color="primary">Изменить</v-btn>-->
                    <!--                        </div>-->
                    <!--                    </v-col>-->
                    <v-col
                        md="10"
                        cols="12"
                    >
                        <div>
                            <h6 class="grey--text pa-1 mb-1">Хобби</h6>
                        </div>
                        <div class="d-flex">
                            <v-textarea
                                flat
                                solo
                                rows="4"
                                class="mr-4"
                                :label="user.hobby"
                                background-color="grey lighten-2"
                                placeholder="Placeholder"
                            ></v-textarea>
                            <v-btn color="primary">Изменить</v-btn>
                        </div>
                    </v-col>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: "Profile",
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
