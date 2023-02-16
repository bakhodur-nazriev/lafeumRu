<template>
    <v-dialog
        v-model="videoDialog"
        width="950"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-card flat rounded="lg" class="mb-6">
                <v-card-text class="pa-4 pb-2 d-flex flex-wrap flex-lg-nowrap">
                    <v-col
                        class="border rounded-lg pa-1"
                        v-bind="attrs"
                        v-on="on"
                    >
                        <v-img class="rounded" :src="video.thumbnail" :alt="video.title"></v-img>
                        <span class="video-duration-block">{{ video.duration + ':00' }}</span>
                    </v-col>

                    <v-col class="pa-3 py-0 videos-title flex-fill">
                        <h5
                            v-bind="attrs"
                            v-on="on"
                        >{{ video.title }}</h5>
                    </v-col>
                </v-card-text>

                <v-card-text class="px-4 py-3 pt-0">
                    <v-col class="pa-0">
                        <a
                            :href="`/channels/` + video.channel.slug"
                            class="channels-links"
                            target="_blank"
                        >
                            <v-icon size="30" class="mr-1" color="red">mdi-youtube</v-icon>
                            <span>{{ video.channel.name }}</span>
                        </a>
                    </v-col>
                    <v-col class="d-flex pa-0 justify-content-between">
                        <v-col class="categories-block pa-0">
                            <a
                                v-for="(category, i) in video.categories"
                                :href="`/videos/` + category.slug"
                                class="mr-2 font-italic"
                                :key="i"
                                target="_blank"
                            >
                                {{ category.name }}
                            </a>
                        </v-col>
                        <v-col class="pa-0 text-end">
                            <a
                                class="videos-id grey--text text-decoration-none"
                                :href="'/' + video.post.id"
                                target="_blank"
                            >
                                #{{ video.post.id }}
                            </a>
                        </v-col>
                    </v-col>
                </v-card-text>
                <v-divider class="m-0 grey lighten-3"></v-divider>
                <v-card-actions class="pa-0 px-1">
                    <div>
                        <v-btn icon>
                            <v-icon color="grey lighten-1">mdi-heart</v-icon>
                        </v-btn>
                        <span>45</span>

                        <v-btn @click="toggleFavorite()" icon>
                            <v-icon :class="[isFavorite ? 'primary--text' : 'grey--text']">mdi-bookmark</v-icon>
                        </v-btn>
                    </div>
                    <v-spacer></v-spacer>
                    <share-button :post="item.post"></share-button>
                </v-card-actions>
            </v-card>
        </template>

        <v-card>
            <v-card-title class="title grey lighten-2 py-3 px-4">
                <v-col class="d-flex pa-0 align-center">
                    <span class="mr-2">{{ video.title }}</span>
                    <v-spacer></v-spacer>
                    <v-btn icon @click="videoDialog = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-col>
            </v-card-title>

            <v-card-text>
                <iframe
                    v-if="videoDialog"
                    class="video-iframe pt-5"
                    frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen=""
                    :src="video.embeded_link"
                ></iframe>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import ShareButton from "../../../components/ShareButton";

export default {
    components: {ShareButton},
    props: ["video"],
    name: "VideoItem",
    data() {
        return {
            item: this.video,
            videoDialog: false,
            isFavorite: !!this.video.favorites.length,
            user: window.Laravel.auth
        };
    },
    methods: {
        toggleFavorite() {
            if (!this.isFavorite) {
                if (this.user) {
                    axios
                        .post('/api/videos/' + this.item.id + '/favorites')
                        .then(res => {
                            console.log(res);
                            if (res.status === 200) {
                                this.isFavorite = true;
                            }
                        })
                        .catch(err => {
                            console.log(err);
                        });

                } else {
                    window.location.href = '/login';
                }
            }

            if (this.isFavorite) {
                if (this.user) {
                    axios
                        .post('/api/videos/' + this.item.id + '/unfavorites')
                        .then(res => {
                            console.log(res);
                            if (res.status === 200) {
                                this.isFavorite = false;
                            }
                        })
                        .catch(err => {
                            console.log(err);
                        });
                } else {
                    window.location.href = '/login';
                }
            }
        }
    }
};
</script>

<style scoped>
@media only screen and (max-width: 600px) {
    .videos-title {
        padding: 10px 0 !important;
    }
}

.categories-block > a {
    text-decoration: none;
    color: #646464 !important;
    caret-color: #646464 !important;
    font-size: 13px;
}

.categories-block > a:hover {
    color: #04718c !important;
}

.video-iframe {
    width: 100%;
    height: 50vh;
}

.videos-id:hover {
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
    right: 10px;
    bottom: 8px;
}

.videos-title > h5 {
    font-size: 18px;
    line-height: 1.3;
    color: #424242;
    margin: 0;
}

.channels-links {
    display: flex;
    align-items: center;
    font-weight: normal;
    line-height: normal;
    width: fit-content;
    text-decoration: none;
    font-size: 18px;
}
</style>
