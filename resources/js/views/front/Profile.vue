<template>
    <v-col lg="9" class="mb-5">
        <v-row justify="center">
            <v-col lg="12">
                <h5 class="text-uppercase font-weight-regular pb-3 mb-0">Профил</h5>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col md="3">
                <v-card
                    tile
                    flat
                    elevation="0"
                    min-width="256"
                    class="mx-auto rounded-lg"
                >
                    <v-list class="d-flex">
                        <v-list-item>
                            <v-list-item-avatar width="70" height="70">
                                <v-img :src="user.avatar"></v-img>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title class="text-h6">{{ user.name }}</v-list-item-title>
                                <v-list-item-subtitle>{{ userRole.name }}</v-list-item-subtitle>
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
            </v-col>

            <v-col md="7" v-if="selectedItem == 0">
                <v-card
                    flat
                    tile
                    width="1030"
                    elevation="0"
                    class="mx-auto rounded-lg pa-4"
                    v-if="selectedItem == 0"
                >
                    <v-col cols="10">
                        <h6 class="grey--text font-weight-regular mb-4">Изменить фотографию профиля</h6>
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
                    <v-col cols="9">
                        <label class="w-100 grey--text text-start font-weight-regular mb-2">Имя
                            пользователя*</label>
                        <div class="d-flex">
                            <v-text-field
                                dense
                                filled
                                rounded
                                clearable
                                hide-details
                                min-height="20"
                                :placeholder="user.name"
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
                    <v-col cols="9">
                        <label class="w-100 grey--text text-start font-weight-regular mb-2">Адрес E-mail*</label>
                        <div class="d-flex">
                            <v-text-field
                                dense
                                filled
                                rounded
                                clearable
                                hide-details
                                :placeholder="user.email"
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
                    <v-col cols="9">
                        <label class="w-100 grey--text text-start font-weight-regular mb-2">Пароль</label>
                        <div class="d-flex">
                            <v-text-field
                                dense
                                rounded
                                filled
                                clearable
                                hide-details
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
            </v-col>

            <v-col md="9" v-if="selectedItem == 1">
                <v-card
                    flat
                    tile
                    elevation="0"
                    class="mx-auto rounded-lg"
                    v-if="selectedItem == 1"
                >
                    <v-toolbar flat>
                        <v-tabs
                            dark
                            fixed-tabs
                            v-model="tabs"
                            background-color="primary"
                        >
                            <v-tabs-slider></v-tabs-slider>
                            <v-tab
                                href="#mobile-tabs-5-1"
                                class="text-decoration-none font-weight-medium"
                            >
                                цитаты
                            </v-tab>
                            <v-tab
                                href="#mobile-tabs-5-2"
                                class="text-decoration-none font-weight-medium"
                            >
                                термины
                            </v-tab>
                            <v-tab
                                href="#mobile-tabs-5-3"
                                class="text-decoration-none font-weight-medium"
                            >видео
                            </v-tab>
                        </v-tabs>
                    </v-toolbar>

                    <v-tabs-items v-model="tabs">
                        <v-tab-item
                            v-for="i in 3"
                            :key="i"
                            :value="'mobile-tabs-5-' + i"
                            class="pa-5"
                        >
                            <v-card rounded="lg" class="mb-6">
                                <v-card-subtitle class="d-flex px-2 py-1 align-center">
                                    <a class="author-show-link primary--text" target="_blank">
                                        <v-icon color="grey dark" size="26">mdi-account</v-icon>
                                        <span class="ml-1">Just test</span>
                                    </a>
                                    <v-spacer></v-spacer>
                                    <a class="quote-id grey--text text-decoration-none" target="_blank">#123456</a>
                                </v-card-subtitle>

                                <v-divider class="m-0 grey lighten-3"></v-divider>

                                <v-card-text class="px-3 py-2">
                                    <v-col class="pa-0 quote-body">
                                        <p class="font-italic grey--text text--darken-3 d-flex caption mb-2">
                                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid distinctio</span>
                                        </p>
                                        <vue-read-more-smooth :lines="15">
                                                    <span class="font-weight-regular quote-body">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex laudantium obcaecati possimus reiciendis. Dignissimos dolore impedit ipsum iure minima nam non quis rem. Animi, aspernatur consequuntur deserunt dignissimos dolores dolorum eaque iusto laudantium minima minus neque, omnis repellendus reprehenderit temporibus?
                                                    </span>
                                            <template v-slot:more="value">
                                                <div class="button-read-more">
                                                    {{ value.open ? "Скрыть" : "Читать далее..." }}
                                                </div>
                                            </template>
                                        </vue-read-more-smooth>
                                    </v-col>
                                    <v-col class="categories-block pa-0">
                                        <a class="mr-2 font-italic" href="#" target="_blank">Just test</a>
                                        <a class="mr-2 font-italic" href="#" target="_blank">Just test</a>
                                        <a class="mr-2 font-italic" href="#" target="_blank">Just test</a>
                                    </v-col>
                                </v-card-text>
                                <v-divider class="m-0 grey lighten-3"></v-divider>
                                <v-card-actions class="pa-0 px-1">
                                    <v-col class="pa-0">
                                        <v-btn
                                            icon
                                            small
                                            @click="likeQuote()"
                                        >
                                            <v-icon size="20" :color="isLiked ? 'red' : 'grey lighten-1'">mdi-heart
                                            </v-icon>
                                        </v-btn>
                                        <span>{{ isLiked ? 1 : 0 }}</span>
                                        <v-btn
                                            icon
                                            small
                                            @click="addToFavourite()"
                                        >
                                            <v-icon size="20" :color="isFavourited ? 'grey lighten-1' : 'primary'">
                                                mdi-bookmark
                                            </v-icon>
                                        </v-btn>
                                    </v-col>
                                    <v-spacer></v-spacer>
                                    <share-button></share-button>
                                </v-card-actions>
                            </v-card>
                            <v-card rounded="lg" class="mb-6">
                                <v-card-subtitle class="d-flex px-2 py-1 align-center">
                                    <a
                                        class="author-show-link primary--text"

                                        target="_blank"
                                    >
                                        <v-icon color="grey dark" size="26">mdi-account</v-icon>
                                        <span class="ml-1">Just test</span>
                                    </a>
                                    <v-spacer></v-spacer>
                                    <a
                                        class="quote-id grey--text text-decoration-none"
                                        target="_blank"
                                    >
                                        #123456
                                    </a>
                                </v-card-subtitle>

                                <v-divider class="m-0 grey lighten-3"></v-divider>

                                <v-card-text class="px-3 py-2">
                                    <v-col class="pa-0 quote-body">
                                        <p class="font-italic grey--text text--darken-3 d-flex caption mb-2">
                                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid distinctio in iste nihil odio officia quas repudiandae rerum similique ullam! Ad consequatur ex ipsa libero natus provident soluta unde voluptates?</span>
                                        </p>
                                        <vue-read-more-smooth :lines="15">
                                                    <span class="font-weight-regular quote-body">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex laudantium obcaecati possimus reiciendis. Dignissimos dolore impedit ipsum iure minima nam non quis rem. Animi, aspernatur consequuntur deserunt dignissimos dolores dolorum eaque iusto laudantium minima minus neque, omnis repellendus reprehenderit temporibus?
                                                    </span>
                                            <template v-slot:more="value">
                                                <div class="button-read-more">
                                                    {{ value.open ? "Скрыть" : "Читать далее..." }}
                                                </div>
                                            </template>
                                        </vue-read-more-smooth>
                                    </v-col>
                                    <v-col class="categories-block pa-0">
                                        <a class="mr-2 font-italic" href="#" target="_blank">Just test</a>
                                        <a class="mr-2 font-italic" href="#" target="_blank">Just test</a>
                                        <a class="mr-2 font-italic" href="#" target="_blank">Just test</a>
                                    </v-col>
                                </v-card-text>
                                <v-divider class="m-0 grey lighten-3"></v-divider>
                                <v-card-actions class="pa-0 px-1">
                                    <v-col class="pa-0">
                                        <v-btn
                                            icon
                                            small
                                            @click="likeQuote()"
                                        >
                                            <v-icon size="20" :color="isLiked ? 'red' : 'grey lighten-1'">mdi-heart
                                            </v-icon>
                                        </v-btn>
                                        <span>{{ isLiked ? 1 : 0 }}</span>
                                        <v-btn
                                            icon
                                            small
                                            @click="addToFavourite()"
                                        >
                                            <v-icon size="20" :color="isFavourited ? 'grey lighten-1' : 'primary'">
                                                mdi-bookmark
                                            </v-icon>
                                        </v-btn>
                                    </v-col>
                                    <v-spacer></v-spacer>
                                    <share-button></share-button>
                                </v-card-actions>
                            </v-card>
                            <v-card rounded="lg" class="mb-6">
                                <v-card-subtitle class="d-flex px-2 py-1 align-center">
                                    <a
                                        class="author-show-link primary--text"

                                        target="_blank"
                                    >
                                        <v-icon color="grey dark" size="26">mdi-account</v-icon>
                                        <span class="ml-1">Just test</span>
                                    </a>
                                    <v-spacer></v-spacer>
                                    <a
                                        class="quote-id grey--text text-decoration-none"
                                        target="_blank"
                                    >
                                        #123456
                                    </a>
                                </v-card-subtitle>

                                <v-divider class="m-0 grey lighten-3"></v-divider>

                                <v-card-text class="px-3 py-2">
                                    <v-col class="pa-0 quote-body">
                                        <p class="font-italic grey--text text--darken-3 d-flex caption mb-2">
                                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid distinctio in iste nihil odio officia quas repudiandae rerum similique ullam! Ad consequatur ex ipsa libero natus provident soluta unde voluptates?</span>
                                        </p>
                                        <vue-read-more-smooth :lines="15">
                                                    <span class="font-weight-regular quote-body">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex laudantium obcaecati possimus reiciendis. Dignissimos dolore impedit ipsum iure minima nam non quis rem. Animi, aspernatur consequuntur deserunt dignissimos dolores dolorum eaque iusto laudantium minima minus neque, omnis repellendus reprehenderit temporibus?
                                                    </span>
                                            <template v-slot:more="value">
                                                <div class="button-read-more">
                                                    {{ value.open ? "Скрыть" : "Читать далее..." }}
                                                </div>
                                            </template>
                                        </vue-read-more-smooth>
                                    </v-col>
                                    <v-col class="categories-block pa-0">
                                        <a class="mr-2 font-italic" href="#" target="_blank">Just test</a>
                                        <a class="mr-2 font-italic" href="#" target="_blank">Just test</a>
                                        <a class="mr-2 font-italic" href="#" target="_blank">Just test</a>
                                    </v-col>
                                </v-card-text>
                                <v-divider class="m-0 grey lighten-3"></v-divider>
                                <v-card-actions class="pa-0 px-1">
                                    <v-col class="pa-0">
                                        <v-btn
                                            icon
                                            small
                                            @click="likeQuote()"
                                        >
                                            <v-icon size="20" :color="isLiked ? 'red' : 'grey lighten-1'">mdi-heart
                                            </v-icon>
                                        </v-btn>
                                        <span>{{ isLiked ? 1 : 0 }}</span>
                                        <v-btn
                                            icon
                                            small
                                            @click="addToFavourite()"
                                        >
                                            <v-icon size="20" :color="isFavourited ? 'grey lighten-1' : 'primary'">
                                                mdi-bookmark
                                            </v-icon>
                                        </v-btn>
                                    </v-col>
                                    <v-spacer></v-spacer>
                                    <share-button></share-button>
                                </v-card-actions>
                            </v-card>
                        </v-tab-item>
                    </v-tabs-items>
                </v-card>
            </v-col>

        </v-row>
    </v-col>
</template>

<script>
import ShareButton from "../../components/ShareButton";
import VueReadMoreSmooth from "vue-read-more-smooth";

export default {
    props: ['user', 'userRole'],
    name: "Profile",
    components: {ShareButton, VueReadMoreSmooth},
    data() {
        return {
            isLiked: false,
            isFavourited: true,
            selectedItem: 1,
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
        likeQuote() {
            this.isLiked = !this.isLiked;
        },
        addToFavourite() {
            this.isFavourited = !this.isFavourited;
        },
    }
}
</script>
