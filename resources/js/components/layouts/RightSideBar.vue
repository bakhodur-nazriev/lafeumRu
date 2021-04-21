<template>
    <v-col xl="2" lg="3" md="4">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">Рекоммендуемые</h5>
        <v-card class="rounded-lg" flat>
            <!-- Quote Section -->
            <div class="pa-5 pb-0">
                <v-card-title class="subtitle-2 font-weight-medium pa-0">Цитата дня
                    <v-spacer></v-spacer>
                    <v-icon>mdi-dots-horizontal</v-icon>
                </v-card-title>
                <v-divider></v-divider>
                <v-card-title class="subtitle-2 font-weight-medium pa-0 mb-1">{{ quote.author.name }}<br/> Категория:
                    Цитата дня
                </v-card-title>
                <v-card-text class="truncate-to-five-line" v-html="quote.body"></v-card-text>
                <v-card-actions class="justify-content-end">
                    <a href="/quotes" class="font-italic">еще.</a>
                </v-card-actions>
            </div>

            <!-- Term Section -->
            <div class="pa-5 pb-0">
                <v-card-title class="subtitle-2 font-weight-medium pa-0">Термин дня</v-card-title>
                <v-divider></v-divider>
                <v-card-text class="truncate-to-five-line" v-html="term.body"></v-card-text>
                <v-card-actions class="justify-content-end">
                    <a href="/terms" class="font-italic">еще.</a>
                </v-card-actions>
            </div>

            <!-- Video section -->
            <div class="pa-5 pb-0">
                <v-card-title class="subtitle-2 font-weight-medium pa-0">Видео дня</v-card-title>
                <v-divider></v-divider>
                <v-card-text class="pa-0 mb-3">
                    <video-embed :src="video.embeded_link"></video-embed>
                </v-card-text>
                <v-card-title class="subtitle-2 font-weight-medium pa-0">{{ video.title }}</v-card-title>
                <v-card-actions class="justify-content-end">
                    <a href="/videos" class="font-italic">еще.</a>
                </v-card-actions>
            </div>

            <!-- Photo Section -->
            <v-dialog v-model="dialog" width="1000">
                <template v-slot:activator="{ on, attrs }">
                    <div class="pa-5">
                        <v-card-title class="subtitle-2 font-weight-medium pa-0">Фотография дня</v-card-title>
                        <v-divider></v-divider>

                        <v-card-text
                            class="pa-0"
                            v-on="on"
                            v-bind="attrs"
                        >
                            <v-img
                                :src="photo.path"
                                :alt="photo.description"
                                max-height="150"
                            ></v-img>
                        </v-card-text>
                        <v-card-actions class="justify-content-end">
                            <a href="/photos" class="font-italic">еще.</a>
                        </v-card-actions>
                    </div>
                </template>
                <v-card>
                    <v-card-title class="headline grey lighten-2">
                        <v-spacer></v-spacer>
                        <v-btn
                            icon
                            @click="dialog = false"
                        >
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>

                    <v-img
                        :src="photo.path"
                        :alt="photo.description"
                    ></v-img>
                </v-card>
            </v-dialog>
        </v-card>
    </v-col>
</template>

<script>
export default {
    name: "RightSideBar",
    props: ["dailyPosts"],
    data() {
        return {
            quote: this.dailyPosts.quote,
            term: this.dailyPosts.term,
            video: this.dailyPosts.video,
            photo: this.dailyPosts.photo,
            dialog: false
        }
    }
}
</script>

<style scoped>
.truncate-to-five-line {
    padding: 0;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
}
</style>
