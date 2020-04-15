<template>
    <v-container fluid>
        <v-row justify="center" class="mb-4">
            <v-col md="6" xl="4">
                <v-text-field
                    solo
                    hide-details
                    label="Поиск"
                    append-icon="mdi-magnify"
                    v-model="search"
                >
                </v-text-field>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-card outlined class="col-lg-12 col-xl-8 p-0">
                <v-tabs
                    v-model="tabs"
                    fixed-tabs
                    background-color="primary"
                    dark
                    flat
                >
                    <v-tabs-slider></v-tabs-slider>
                    <v-tab href="#mobile-tabs-1" class="text-decoration-none">
                        Цитаты
                    </v-tab>
                    <v-tab href="#mobile-tabs-2" class="text-decoration-none">
                        Термины
                    </v-tab>
                    <v-tab href="#mobile-tabs-3" class="text-decoration-none">
                        Видео
                    </v-tab>
                </v-tabs>
                <v-tabs-items v-model="tabs">
                    <!-- Quotes Tab -->
                    <v-tab-item value="mobile-tabs-1">
                        <v-card
                            class="ma-4 pa-2"
                            v-for="(quote, i) in favouriteQuotes"
                            :key="i"
                        >
                            <v-col class="d-flex align-center justify-space-between py-0">
                                <a href="#" style="color: #a6192e; text-decoration: none">
                                    <v-icon color="#a6192e">mdi-account</v-icon>
                                    {{quote.favoriteable.author.name}}
                                </a>
                                <v-tooltip left>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            fab
                                            dark
                                            small
                                            color="red"
                                            v-on="on"
                                            @click="unFavourite(quote.favoriteable.id, 'App\\Quote')"
                                        >
                                            <v-icon dark>mdi-delete-empty</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Удалить избранный</span>
                                </v-tooltip>
                            </v-col>
                            <v-col class="pa-2">
                                <p class="mb-2">
                                    {{ quote.favoriteable.body }}
                                </p>
                                <span
                                    v-for="(category, i) in quote.favoriteable.categories"
                                    :key="i"
                                    class="mr-2"
                                >
                                    <a href="#" class="text-decoration-none">
                                        <v-icon small color="primary">
                                            mdi-tag-multiple
                                        </v-icon>
                                        {{ category.name }}
                                    </a>
                                </span>
                                <v-divider style="background-color: #a6192e"></v-divider>
                                <v-btn depressed small color="primary">Поделиться</v-btn>
                            </v-col>
                        </v-card>
                    </v-tab-item>
                    <!-- Terms Tab -->
                    <v-tab-item value="mobile-tabs-2">
                        <v-card
                            class="ma-4 pa-2"
                            v-for="(term, i) in favouriteTerms"
                            :key="i"
                        >
                            <v-col class="d-flex align-center justify-space-between py-0">
                                <span>
                                    <v-icon color="#a6192e">mdi-atom</v-icon>
                                    <v-icon color="#a6192e">mdi-atom</v-icon>
                                    <v-icon color="#a6192e">mdi-atom</v-icon>
                                </span>
                                <v-tooltip left>
                                    <template v-slot:activator="{ on }">
                                        <v-btn
                                            fab
                                            dark
                                            small
                                            color="red"
                                            v-on="on"
                                            @click="unFavourite(term.favoriteable.id, 'App\\Term')"
                                        >
                                            <v-icon dark>mdi-delete-empty</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Удалить избранный</span>
                                </v-tooltip>
                            </v-col>
                            <v-col class="pa-2" v-html="term.favoriteable.body"/>
                            <v-col class="pa-2">
                                <span
                                    v-for="(category, i) in term.favoriteable.categories"
                                    :key="i"
                                    class="mr-2"
                                >
                                    <a href="#" class="text-decoration-none">
                                        <v-icon small color="primary">mdi-tag-multiple</v-icon>
                                        <span>{{ category.name }}</span>
                                    </a>
                                </span>
                                <v-divider style="background-color: #a6192e"></v-divider>
                                <v-btn depressed small color="primary">Поделиться</v-btn>
                            </v-col>
                        </v-card>
                    </v-tab-item>
                    <!-- Videos Tab -->
                    <v-tab-item value="mobile-tabs-3">
                        <v-col class="col-10 offset-1 py-3">
                            <v-row>
                                <v-col
                                    class="col-6 px-4"
                                    v-for="(video, i) in favouriteVideos"
                                    :key="i"
                                >
                                    <v-card class="pa-4 d-flex flex-column h-100">
                                        <div class="mb-2">
                                            <v-col class="d-flex align-center justify-space-between py-0">
                                                <a href="#" class="text-decoration-none">
                                                    <v-icon color="headary">mdi-youtube</v-icon>
                                                    {{ video.favoriteable.channel.name }}
                                                </a>
                                                <v-tooltip left>
                                                    <template v-slot:activator="{ on }">
                                                        <v-btn
                                                            fab
                                                            dark
                                                            x-small
                                                            color="red"
                                                            depressed
                                                            v-on="on"
                                                            @click="unFavourite(video.favoriteable.id, 'App\\Video')"
                                                        >
                                                            <v-icon dark>mdi-delete-empty</v-icon>
                                                        </v-btn>
                                                    </template>
                                                    <span>Удалить избранный</span>
                                                </v-tooltip>
                                            </v-col>

                                            <div class="my-3">
                                                <iframe
                                                    class="w-100"
                                                    :style="{ height: '230px' }"
                                                    :src="video.favoriteable.link"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen=""
                                                />
                                            </div>
                                            <h5>{{ video.favoriteable.title }}</h5>
                                        </div>
                                        <v-spacer></v-spacer>
                                        <div>
                                            <span
                                                v-for="(category, i) in video.favoriteable.categories"
                                                :key="i"
                                                class="mr-2"
                                            >
                                                <a href="#" class="text-decoration-none">
                                                    <v-icon small color="primary">mdi-tag-multiple</v-icon>
                                                    <span>{{ category.name }}</span>
                                                </a>
                                            </span>
                                            <v-divider class=" my-4"></v-divider>
                                            <div class="d-flex justify-space-between">
                                                <v-btn depressed small color="primary">Поделиться</v-btn>
                                                <span>{{ video.favoriteable.duration }} мин.</span>
                                            </div>
                                        </div>
                                    </v-card>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-tab-item>
                </v-tabs-items>
            </v-card>
        </v-row>
    </v-container>
</template>

<script>
    const QUOTE_TYPE = "App\\Quote";
    const TERM_TYPE = "App\\Term";
    const VIDEO_TYPE = "App\\Video";

    export default {
        data() {
            return {
                search: "",
                favourites: [],
                tabs: null,
            };
        },
        mounted() {
            this.loadFavourites();
        },
        methods: {
            loadFavourites() {
                axios
                    .get("/api/favourites")
                    .then(res => (this.favourites = res.data))
                    .catch(err => {
                        console.log(err);
                    });
            },
            unFavourite(id, favouritable) {
                axios
                    .put("/toggle-favourite", {id, favouritable})
                    .then(res => {
                        this.loadFavourites();
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        },
        computed: {
            filteredFavorite() {
                if (!Array.isArray(this.favourites)) return;

                return this.favourites.filter(favourite => {
                    return favourite.body
                        .toLowerCase()
                        .includes(this.search.toLowerCase());
                });
            },
            favouriteQuotes() {
                if (!Array.isArray(this.favourites)) return;

                return this.favourites.filter(
                    favourite => favourite.favoriteable_type === QUOTE_TYPE
                );
            },
            favouriteTerms() {
                if (!Array.isArray(this.favourites)) return;

                return this.favourites.filter(
                    favourite => favourite.favoriteable_type === TERM_TYPE
                );
            },
            favouriteVideos() {
                if (!Array.isArray(this.favourites)) return;

                return this.favourites.filter(
                    favourite => favourite.favoriteable_type === VIDEO_TYPE
                );
            }
        }
    };
</script>
