<template>
    <v-col
        xl="2"
        lg="3"
        md="5"
        sm="6"
        class="fill-height right-main-block col-12"
    >
        <v-col class="hidden-sm-and-up pa-0">
            <v-expansion-panels flat>
                <v-expansion-panel>
                    <v-expansion-panel-header class="text-uppercase font-weight-medium">
                        Рекомендуемые
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <!-- Quote Section -->
                        <div class="pa-0">
                            <v-card-title class="subtitle-2 font-weight-bold pa-0">Цитата дня
                                <v-spacer></v-spacer>
                                <v-icon>mdi-dots-horizontal</v-icon>
                            </v-card-title>
                            <v-divider></v-divider>
                            <v-card-title
                                class="subtitle-2 font-weight-medium pa-0 mb-1 d-flex flex-column justify-start">
                                <a :href="'/authors/' + quote.author.slug" class="w-100">{{ quote.author.name }}</a>
                            </v-card-title>
                            <v-card-text
                                class="truncate-to-seven-line title-break-word text-justify"
                                v-html="quote.body"
                            ></v-card-text>
                            <v-card-actions class="justify-content-end py-0">
                                <v-btn
                                    icon
                                    href="/quotes"
                                    target="_blank"
                                    class="text-decoration-none"
                                >
                                    <v-icon color="black" small>mdi-chevron-down</v-icon>
                                </v-btn>
                            </v-card-actions>
                        </div>

                        <!-- Term Section -->
                        <div class="pa-0">
                            <v-card-title class="subtitle-2 font-weight-bold pa-0">Термин дня</v-card-title>
                            <v-divider></v-divider>
                            <v-card-text
                                class="truncate-to-seven-line title-break-word text-justify"
                                v-html="term.body"
                            ></v-card-text>
                            <v-card-actions class="justify-content-end py-0">
                                <v-btn
                                    icon
                                    href="/terms"
                                    target="_blank"
                                    class="text-decoration-none"
                                >
                                    <v-icon color="black" small>mdi-chevron-down</v-icon>
                                </v-btn>
                            </v-card-actions>
                        </div>

                        <!-- Video section -->
                        <v-dialog v-model="smallVideoDialog" width="900">
                            <template v-slot:activator="{ on, attrs }">
                                <div class="pa-0">
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
                                    <v-card-actions class="justify-content-end py-0">
                                        <v-btn
                                            icon
                                            href="/videos"
                                            target="_blank"
                                            class="text-decoration-none"
                                        >
                                            <v-icon color="black" small>mdi-chevron-down</v-icon>
                                        </v-btn>
                                    </v-card-actions>
                                </div>
                            </template>
                            <v-card>
                                <v-card-title class="grey lighten-2 py-3 px-4">
                                    <div class="d-flex align-center justify-content-between w-100">
                                        <span class="subtitle-1 font-weight-medium">{{ video.title }}</span>
                                        <v-btn icon @click="smallVideoDialog = false">
                                            <v-icon>mdi-close</v-icon>
                                        </v-btn>
                                    </div>
                                </v-card-title>

                                <v-card-text class="pa-6 pb-5">
                                    <iframe
                                        v-if="smallVideoDialog"
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
                        <v-dialog v-model="smallPhotoDialog" width="1000">
                            <template v-slot:activator="{ on, attrs }">
                                <div class="pa-0">
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
                                        ></v-img>
                                        <v-card-subtitle
                                            class="text--primary truncate-to-seven-line text-justify pa-0 pt-3"
                                        >
                                            {{ photo.description }}
                                        </v-card-subtitle>
                                    </v-card-text>
                                    <v-card-actions class="justify-content-end py-0">
                                        <v-btn
                                            icon
                                            href="/photos"
                                            target="_blank"
                                            class="text-decoration-none"
                                        >
                                            <v-icon color="black" small>mdi-chevron-down</v-icon>
                                        </v-btn>
                                    </v-card-actions>
                                </div>
                            </template>
                            <v-card>
                                <v-card-title class="headline grey lighten-2">
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        icon
                                        @click="smallPhotoDialog = false"
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
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-col>

        <v-col class="fill-height hidden-xs-only pa-0">
            <h5 class="text-uppercase font-weight-normal py-4 mb-0">Рекомендуемые</h5>
            <v-card class="rounded-lg" flat>
                <!-- Quote Section -->
                <div class="pt-4 px-4 pb-0">
                    <v-card-title class="subtitle-2 font-weight-bold pa-0">
                        Цитата дня
                        <v-spacer></v-spacer>
                        <v-icon>mdi-dots-horizontal</v-icon>
                    </v-card-title>
                    <v-divider class="my-2"></v-divider>
                    <v-card-title class="subtitle-2 pa-0 mb-1 d-flex justify-space-between">
                        <v-col class="pa-0">
                            <a
                                class="primary--text daily-authors-author text-break"
                                target="_blank"
                                :href="'/authors/'+quote.author.slug"
                            >
                                {{ quote.author.name }}
                            </a>
                        </v-col>
                        <v-avatar>
                            <img :src="quote.author.photo" :alt="quote.author.name">
                        </v-avatar>
                    </v-card-title>
                    <v-card-text
                        class="truncate-to-seven-line title-break-word text-justify"
                        v-html="quote.body"
                    ></v-card-text>
                    <v-card-actions class="justify-content-end pr-0 pb-0">
                        <v-btn
                            icon
                            href="/quotes"
                            target="_blank"
                            class="text-decoration-none"
                        >
                            <v-icon color="black" small>mdi-chevron-down</v-icon>
                        </v-btn>
                        <v-icon small>mdi-</v-icon>
                    </v-card-actions>
                </div>

                <!--Term Section-->
                <div class="px-4 py-0">
                    <v-card-title class="subtitle-2 font-weight-bold pa-0">Термин дня</v-card-title>
                    <v-divider class="my-2"></v-divider>
                    <v-card-text
                        class="truncate-to-seven-line title-break-word text-justify"
                        v-html="term.body"
                    ></v-card-text>
                    <v-card-actions class="justify-content-end pr-0 pb-0">
                        <v-btn
                            icon
                            href="/terms"
                            target="_blank"
                            class="text-decoration-none"
                        >
                            <v-icon color="black" small>mdi-chevron-down</v-icon>
                        </v-btn>
                    </v-card-actions>
                </div>

                <!-- Video section -->
                <v-dialog v-model="bigVideoDialog" width="900">
                    <template v-slot:activator="{ on, attrs }">
                        <div class="px-4 py-0">
                            <v-card-title class="subtitle-2 font-weight-bold pa-0">Видео дня</v-card-title>
                            <v-divider class="mt-2 mb-3"></v-divider>
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
                            <v-card-title class="subtitle-2 pa-0 title-break-word text-justify">
                                {{ video.title }}
                            </v-card-title>
                            <v-card-actions class="justify-content-end pr-0 pb-0">
                                <v-btn
                                    icon
                                    href="/videos"
                                    target="_blank"
                                    class="text-decoration-none"
                                >
                                    <v-icon color="black" small>mdi-chevron-down</v-icon>
                                </v-btn>
                            </v-card-actions>
                        </div>
                    </template>
                    <v-card>
                        <v-card-title class="grey lighten-2 py-3 px-4 ">
                            <div class="d-flex align-center justify-content-between w-100">
                                <span class="subtitle-1 font-weight-medium">{{ video.title }}</span>
                                <v-btn icon @click="bigVideoDialog = false">
                                    <v-icon>mdi-close</v-icon>
                                </v-btn>
                            </div>
                        </v-card-title>

                        <v-card-text class="pa-6 pb-5">
                            <iframe
                                v-if="bigVideoDialog"
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
                <v-dialog v-model="bigPhotoDialog" width="1000">
                    <template v-slot:activator="{ on, attrs }">
                        <div class="px-4 py-0">
                            <v-card-title class="subtitle-2 font-weight-bold pa-0">Фотография дня</v-card-title>
                            <v-divider class="mt-2 mb-4"></v-divider>
                            <v-card-text class="pa-0" v-on="on" v-bind="attrs">
                                <v-img
                                    :src="photo.path"
                                    :alt="photo.description"
                                    max-height="150"
                                ></v-img>
                                <v-card-subtitle
                                    class="text--primary truncate-to-seven-line text-justify pa-0 pt-3"
                                >
                                    {{ photo.description }}
                                </v-card-subtitle>
                            </v-card-text>
                            <v-card-actions class="justify-content-end pa-0">
                                <v-btn
                                    icon
                                    href="/photos"
                                    target="_blank"
                                    class="text-decoration-none"
                                >
                                    <v-icon color="black" small>mdi-chevron-down</v-icon>
                                </v-btn>
                            </v-card-actions>
                        </div>
                    </template>
                    <v-card>
                        <v-card-title class="headline grey lighten-2">
                            <v-spacer></v-spacer>
                            <v-btn icon @click="bigPhotoDialog = false">
                                <v-icon>mdi-close</v-icon>
                            </v-btn>
                        </v-card-title>

                        <v-card-text class="pt-5">
                            <v-img :src="photo.path" :alt="photo.description"></v-img>
                        </v-card-text>
                    </v-card>
                </v-dialog>
            </v-card>
        </v-col>
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
            bigVideoDialog: false,
            smallVideoDialog: false,
            bigPhotoDialog: false,
            smallPhotoDialog: false,
        }
    },
}
</script>

<style scoped>
@media (max-width: 600px) {
    .right-main-block {
        order: -1;
        padding-top: 15px;
    }
}

.daily-authors-author {
    text-decoration: none;
    font-weight: 600;
}

.video-iframe {
    width: 100%;
    height: 50vh;
}

.title-break-word {
    word-break: break-word;
}

.truncate-to-seven-line {
    padding: 0;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 7;
    -webkit-box-orient: vertical;
}

v-card__text > a {
    color: #04718c !important;
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
