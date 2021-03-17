<template>
    <v-container>
        <v-row>
            <v-col>
                <h1 class="text-subtitle-1 text-md-h6 text-uppercase">Фотографии</h1>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="6" lg="4" xl="3" v-for="(c,i) in 4" :key="i">
                <v-card class="mx-auto" elevation="0" max-width="540" rounded="lg">
                    <v-card-actions class="pa-12 pb-3">
                        <v-img class="d-block ma-auto" src="https://strana.ua/img/article/2625/70_main.jpeg"></v-img>
                    </v-card-actions>
                    <v-card-title class="pl-12 py-0 text-h6 text-md-subtitle-1">
                        Название фотографии, смысл ?
                    </v-card-title>
                    <v-card-text class="px-12 pt-2 text-subtitle-1 text-md-subtitle-2">
                        Передо мной фотография, сделанная в музее палеонтологии. 
                        В центре изображен мальчик в белом свитере и темных джинсах,
                        стоящий перед витриной с экспонатами
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row justify="center">
                <v-btn class="btn"
                    fab
                    small
                    elevation="0"
                    rounded
                    color="grey lighten-2"
                >
                    <v-icon color="white">mdi-arrow-down</v-icon>
                </v-btn>
        </v-row>
        <v-row>
            <v-col cols="12">
                <div class="center text-center">
                    <v-pagination
                        v-model="page"
                        :length="3"
                    ></v-pagination>
                </div>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    export default {
        name: "Photos",
        data() {
            return {
                page: 1,
                pageCustom: 1
            }
        }
    }
</script>

<style scoped="scoped">
    .btn:active {
        border: none;
    }
    .custom .v-pagination .v-pagination__navigation {
    background: #9c2a2a !important;
    border: red solid;
}
</style>