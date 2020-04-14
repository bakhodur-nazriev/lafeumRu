<template>
    <v-container>
        <v-row justify="center">
            <v-col md="6">
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
        <v-row class="mt-4">
            <v-card class="col-12 p-0">
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
                    <v-tab-item value="mobile-tabs-1">
                        <v-card
                            class="ma-4 pa-2"
                            v-for="(quote, i) in favouriteQuotes"
                            :key="i"
                        >
                            <v-col><a v-html="quote.favoriteable.author.name" href="#"></a></v-col>
                            <v-col class="pa-2">
                                <p class="mb-2">
                                    {{ quote.favoriteable.body }}
                                </p>
                                <span
                                    v-for="(category, i) in quote.favoriteable.categories"
                                    :key="i"
                                    class="mr-2"
                                >
                                    <v-icon small color="primary">mdi-tag</v-icon>
                                    <span>{{ category.name }}</span>
                                </span>
                                <v-divider class="my-2"></v-divider>
                                <v-btn depressed small color="primary">Поделиться</v-btn>
                            </v-col>
                        </v-card>
                    </v-tab-item>

                    <v-tab-item value="mobile-tabs-2">
                        <v-card
                            class="ma-4 pa-2"
                            v-for="(term, i) in favouriteTerms"
                            :key="i"
                        >
                            <div class="pa-2" v-html="term.favoriteable.body"/>
                            <v-col class="pa-2">
                                <span
                                    v-for="(category, i) in term.favoriteable.categories"
                                    :key="i"
                                    class="mr-2"
                                >
                                    <v-icon small color="primary">mdi-tag</v-icon>
                                    <span>{{ category.name }}</span>
                                </span>
                                <v-divider class="my-2"></v-divider>
                                <v-btn depressed small color="primary">Поделиться</v-btn>
                            </v-col>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item value="mobile-tabs-3">
                        <v-col>
                            <v-row>
                                <v-col
                                    class="col-4"
                                    v-for="(video, i) in favouriteVideos"
                                    :key="i"
                                >
                                    <v-card class="pa-4 d-flex flex-column h-100">
                                        <div class="mb-2">
                                            <a class="mb-2">{{ video.favoriteable.channel.name }}</a>
                                            <div>
                                                <iframe
                                                    class="w-100"
                                                    :style="{ height: '230px' }"
                                                    :src="video.favoriteable.link"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen=""
                                                />
                                            </div>
                                            <h5>
                                                {{ video.favoriteable.title }}
                                            </h5>
                                        </div>
                                        <v-spacer></v-spacer>
                                        <div>
                                            <span
                                                v-for="(category, i) in video.favoriteable.categories"
                                                :key="i"
                                                class="mr-2"
                                            >
                                                <v-icon small color="primary">mdi-tag</v-icon>
                                                <span>{{ category.name }}</span>
                                            </span>
                                            <v-divider class="my-2"></v-divider>
                                            <v-btn depressed small color="primary">Поделиться</v-btn>
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
                tabs: null
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
