<template>
    <v-col lg="9" class="mb-5">
        <v-row justify="center">
            <v-col lg="12">
                <h5 class="text-uppercase font-weight-regular pb-3 mb-0">Профил</h5>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-card
                tile
                flat
                width="256"
                elevation="0"
                class="mx-auto rounded-lg"
            >
                <v-list class="d-flex">
                    <v-list-item>
                        <v-list-item-avatar width="70" height="70">
                            <v-img :src="user.avatar"></v-img>
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title class="text-h6">{{ user.name }}</v-list-item-title>
                            <v-list-item-subtitle>{{ user.email }}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>

                <v-divider></v-divider>

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
                                <v-list-item-title v-text="item.title"></v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>

                        <v-divider></v-divider>

                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon>mdi-logout</v-icon>
                            </v-list-item-icon>

                            <v-list-item-content>
                                <v-list-item-title>Выход</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-item-group>
                </v-list>
            </v-card>

            <!--<v-card
                flat
                tile
                width="900"
                elevation="0"
                class="mx-auto rounded-lg"
            >
                <v-col cols="10">
                    <h6 class="grey&#45;&#45;text font-weight-regular mb-4">Изменить фотографию профиля</h6>
                    <v-avatar class="mr-5" size="100">
                        <img :src="user.avatar">
                    </v-avatar>
                    <v-btn
                        depressed
                        height="40"
                        type="submit"
                        color="primary"
                        class="mr-3 rounded-lg text-capitalize"
                    >
                        Изменить аватарку
                    </v-btn>
                    <v-btn
                        depressed
                        height="40"
                        color="primary"
                        class="rounded-lg text-capitalize"
                    >
                        Удалить
                    </v-btn>
                </v-col>
                <v-col cols="10">
                    <label class="w-100 grey&#45;&#45;text text-start font-weight-regular mb-2">Имя
                        пользователя*</label>
                    <div class="d-flex">
                        <v-text-field
                            dense
                            filled
                            rounded
                            clearable
                            hide-details
                            min-height="20"
                            :label="user.name"
                            class="rounded-lg mr-4"
                        />
                        <v-btn
                            depressed
                            height="40"
                            color="primary"
                            class="rounded-lg text-capitalize"
                        >
                            Сохранить изменения
                        </v-btn>
                    </div>
                </v-col>
                <v-col cols="10">
                    <label class="w-100 grey&#45;&#45;text text-start font-weight-regular mb-2">Адрес E-mail*</label>
                    <div class="d-flex">
                        <v-text-field
                            dense
                            filled
                            rounded
                            clearable
                            hide-details
                            :label="user.email"
                            class="rounded-lg mr-4"
                        ></v-text-field>
                        <v-btn
                            depressed
                            height="40"
                            type="submit"
                            color="primary"
                            class="rounded-lg text-capitalize"
                        >
                            Сохранить изменения
                        </v-btn>
                    </div>
                </v-col>
                <v-col cols="10">
                    <label class="w-100 grey&#45;&#45;text text-start font-weight-regular mb-2">Пароль</label>
                    <div class="d-flex">
                        <v-text-field
                            filled
                            rounded
                            clearable
                            hide-details
                            :label="user.password"
                            class="rounded-lg mr-4"
                        ></v-text-field>
                        <v-btn
                            depressed
                            height="40"
                            type="submit"
                            color="primary"
                            class="rounded-lg text-capitalize"
                        >
                            Сохранить изменения
                        </v-btn>
                    </div>
                </v-col>
            </v-card>

            <v-card
                flat
                tile
                width="1030"
                elevation="0"
                class="mx-auto rounded-lg"
            >
                <v-toolbar flat>
                    <v-tabs
                        v-model="tabs"
                        fixed-tabs
                    >
                        <v-tabs-slider></v-tabs-slider>
                        <v-tab
                            href="#mobile-tabs-5-1"
                            class="primary--text text-decoration-none"
                        >
                            цитаты
                        </v-tab>

                        <v-tab
                            href="#mobile-tabs-5-2"
                            class="primary--text text-decoration-none"
                        >
                            термины
                        </v-tab>

                        <v-tab
                            href="#mobile-tabs-5-3"
                            class="primary--text text-decoration-none"
                        >
                            видео
                        </v-tab>
                    </v-tabs>
                </v-toolbar>

                <v-tabs-items v-model="tabs">
                    <v-tab-item
                        v-for="i in 3"
                        :key="i"
                        :value="'mobile-tabs-5-' + i"
                    >
                        <v-card flat>
                            <v-card-text v-text="text"></v-card-text>
                        </v-card>
                    </v-tab-item>
                </v-tabs-items>
            </v-card>-->
        </v-row>
    </v-col>
</template>

<script>
export default {
    name: "Profile",
    data() {
        return {
            user: window.Laravel.auth,
            selectedItem: 0,
            role: '',
            tabs: null,
            text: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi at deleniti error ex omnis perspiciatis quia, quis voluptatibus! Amet architecto aut doloremque expedita facere illum magnam magni necessitatibus possimus quasi, quibusdam repellat reprehenderit saepe ut voluptatibus? Ab alias in libero natus voluptate. Dolorem doloribus, odio.',
            items: [
                {
                    href: "",
                    title: "Редактировать",
                    icon: "mdi-account-circle"
                },
                {
                    href: "",
                    title: "Избранное",
                    icon: "mdi-briefcase"
                },
                {
                    href: "",
                    title: "Настройки",
                    icon: "mdi-tune"
                }
            ]
        }
    },
    methods: {
        loadRole() {
            axios
                .get("/api/roles")
                .then()
                .catch()
        }
    },
    mounted() {
        this.loadRole();
    }
}
</script>

<style scoped>

</style>
