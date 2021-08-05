<template>
    <v-col xl="3" lg="3" md="3" class="right-main-block fill-height">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">Рекомендуемые</h5>
        <v-card class="rounded-lg" flat>
            <!-- Quote Section -->
            <div class="pa-5 pb-0">
                <v-card-title class="subtitle-2 font-weight-bold pa-0">Цитата дня
                    <v-spacer></v-spacer>
                    <v-icon>mdi-dots-horizontal</v-icon>
                </v-card-title>
                <v-divider></v-divider>
                <v-card-title class="subtitle-2 font-weight-medium pa-0 mb-1">{{ quote.author.name }}<br/> Категория:
                    Цитата дня
                </v-card-title>
                <v-card-text
                    class="truncate-to-five-line title-break-word"
                    v-html="quote.body"
                ></v-card-text>
                <v-card-actions class="justify-content-end">
                    <a href="/quotes" class="more-button">
                        <v-icon small>mdi-chevron-right</v-icon>
                    </a>
                    <v-icon small>mdi-</v-icon>
                </v-card-actions>
            </div>

            <!-- Term Section -->
            <div class="pa-5 pb-0">
                <v-card-title class="subtitle-2 font-weight-bold pa-0">Термин дня</v-card-title>
                <v-divider></v-divider>
                <v-card-text
                    class="truncate-to-five-line title-break-word"
                    v-html="term.body"
                ></v-card-text>
                <v-card-actions class="justify-content-end">
                    <a href="/terms" class="more-button">
                        <v-icon color="black" small>mdi-chevron-right</v-icon>
                    </a>
                </v-card-actions>
            </div>

            <!-- Video section -->
            <v-dialog v-model="dialogVideo" width="900">
                <template v-slot:activator="{ on, attrs }">
                    <div class="pa-5 pb-0">
                        <v-card-title class="subtitle-2 font-weight-bold pa-0">Видео дня</v-card-title>
                        <v-divider></v-divider>
                        <v-card-text
                            v-on="on"
                            v-bind="attrs"
                            class="pa-0 mb-2"
                        >
                            <v-col class="text-right pa-0">
                                <img class="img-thumbnail" :src="video.thumbnail"/>
                                <span class="video-duration-block">{{ video.duration + ':00' }}</span>
                            </v-col>
                        </v-card-text>
                        <v-card-title class="subtitle-2 font-weight-medium pa-0 title-break-word">
                            {{ video.title }}
                        </v-card-title>
                        <v-card-actions class="justify-content-end">
                            <a href="/videos" class="more-button">
                                <v-icon color="black" small>mdi-chevron-right</v-icon>
                            </a>
                        </v-card-actions>
                    </div>
                </template>
                <v-card>
                    <v-card-title class="grey lighten-2 py-3 px-4 ">
                        <div class="d-flex align-center justify-content-between w-100">
                            <span class="subtitle-1 font-weight-medium">{{ video.title }}</span>
                            <v-btn icon @click="dialogVideo = false">
                                <v-icon>mdi-close</v-icon>
                            </v-btn>
                        </div>
                    </v-card-title>

                    <v-card-text class="pa-6 pb-5">
                        <iframe
                            class="video-iframe"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen=""
                            :src="video.embeded_link"
                        ></iframe>
                    </v-card-text>
                </v-card>
            </v-dialog>

            <!-- Photo Section -->
            <v-dialog v-model="dialogPhoto" width="1000">
                <template v-slot:activator="{ on, attrs }">
                    <div class="pa-5">
                        <v-card-title class="subtitle-2 font-weight-bold pa-0">Фотография дня</v-card-title>
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
                            <a href="/photos" class="more-button">
                                <v-icon color="black" small>mdi-chevron-right</v-icon>
                            </a>
                        </v-card-actions>
                    </div>
                </template>
                <v-card>
                    <v-card-title class="headline grey lighten-2">
                        <v-spacer></v-spacer>
                        <v-btn
                            icon
                            @click="dialogPhoto = false"
                        >
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>

                    <v-card-text class="pt-5">
                        <v-img
                            :src="photo.path"
                            :alt="photo.description"
                        ></v-img>
                    </v-card-text>
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
            dialogVideo: false,
            dialogPhoto: false
        }
    }
}
</script>

<style scoped>
@media (min-width: 1904px) {
    .right-main-block {
        max-width: 22% !important;
    }
}

.video-iframe {
    width: 100%;
    height: 50vh;
}

.title-break-word {
    word-break: break-word;
}

.more-button {
    text-decoration: none;
    border: 2px solid #000;
    display: flex;
    border-radius: 4px;
}

.truncate-to-five-line {
    padding: 0;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
}

.video-duration-block {
    font-size: 12px;
    background-color: black;
    color: white;
    border-radius: 10%;
    padding: 0 5px;
    font-weight: 600;
    position: absolute;
    right: 8px;
    bottom: 8px;
}

.img-thumbnail {
    width: 100%;
}
</style>
