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
            <v-card>
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
                    <v-tab href="#mobile-tabs-5-4" class="text-decoration-none">
                        Словарь
                    </v-tab>
                </v-tabs>

                <v-tabs-items v-model="tabs">
                    <v-tab-item
                        v-for="i in 4"
                        :key="i"
                        :value="'mobile-tabs-5-' + i"
                    >
                        <v-card flat>
                            <v-card-text v-text="text"></v-card-text>
                        </v-card>
                    </v-tab-item>
                </v-tabs-items>
            </v-card>
        </v-row>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                search: "",
                favorites: [],
                tabs: null,
                text: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi cum exercitationem fugiat necessitatibus nihil nisi non officia omnis perspiciatis recusandae. Aperiam distinctio dolor eligendi enim, fugit iusto natus nemo neque odio pariatur recusandae sint tenetur velit! Amet aperiam dolorum earum hic, illo laboriosam neque porro possimus quae quis repellat, velit?'
            }
        },
        computed: {
            filteredFavorite() {
                return this.favorites.filter(favorite => {
                    return favorite.body.toLowerCase().includes(this.search.toLowerCase());
                })
            }
        }
    };
</script>

<style scoped>

</style>
