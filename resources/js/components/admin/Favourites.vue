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
                    <v-tab href="#mobile-tabs-5-1" class="text-decoration-none">
                        Цитаты
                    </v-tab>
                    <v-tab href="#mobile-tabs-5-2" class="text-decoration-none">
                        Термины
                    </v-tab>
                    <v-tab href="#mobile-tabs-5-3" class="text-decoration-none">
                        Видео
                    </v-tab>
                </v-tabs>

                <v-tabs-items v-model="tabs">
                    <v-tab-item
                        :value="'mobile-tabs-5-' + i"
                    >
                        
                    </v-tab-item>
                    <v-tab-item
                        :value="'mobile-tabs-5-' + i"
                    >
                        
                    </v-tab-item>
                    <v-tab-item
                        :value="'mobile-tabs-5-' + i"
                    >
                        
                    </v-tab-item>
                    <v-tab-item
                        :value="'mobile-tabs-5-' + i"
                    >
                        
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
            text:
                "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi cum exercitationem fugiat necessitatibus nihil nisi non officia omnis perspiciatis recusandae. Aperiam distinctio dolor eligendi enim, fugit iusto natus nemo neque odio pariatur recusandae sint tenetur velit!"
        };
    },
    mounted() {
        this.loadFavourites();
    },
    methods: {
        loadFavourites() {
            axios
                .get("/api/favourites")
                .then(res => this.favourites = res.data)
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        filteredFavorite() {
            if(!Array.isArray(this.favourites)) return;

            return this.favourites.filter(favourite => {
                return favourite.body
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
        favouriteQuotes() {
            if(!Array.isArray(this.favourites)) return;

            return this.favourites.filter(favourite => favourite.favoriteable_type === QUOTE_TYPE);
        },
        favouriteTerms() {
            if(!Array.isArray(this.favourites)) return;

            return this.favourites.filter(favourite => favourite.favoriteable_type === TERM_TYPE);
        },
        favouriteVideos() {
            if(!Array.isArray(this.favourites)) return;

            return this.favourites.filter(favourite => favourite.favoriteable_type === VIDEO_TYPE);
        }
    }
};
</script>
