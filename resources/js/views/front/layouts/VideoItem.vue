<template>
    <v-card flat rounded="lg" class="mb-6">
        <v-dialog v-model="videoDialog" width="950">
            <template v-slot:activator="{ on, attrs }">
                <v-card flat rounded="lg" class="mb-6">
                    <v-card-text class="pa-4 pb-2 d-flex flex-wrap flex-lg-nowrap">
                        <v-col class="border rounded-lg pa-1" v-bind="attrs" v-on="on">
                            <v-img class="rounded" :src="video.thumbnail" :alt="video.title"></v-img>
                            <span class="video-duration-block">{{ video.duration + ':00' }}</span>
                        </v-col>

                        <v-col class="pa-3 py-0 videos-title flex-fill">
                            <h5 v-bind="attrs" v-on="on">{{ video.title }}</h5>
                        </v-col>
                    </v-card-text>

                    <v-card-text class="px-4 py-3 pt-0">
                        <v-col class="pa-0">
                            <a :href="`/channels/` + video.channel.slug" class="channels-links" target="_blank">
                                <v-icon size="30" class="mr-1" color="red">mdi-youtube</v-icon>
                                <span>{{ video.channel.name }}</span>
                            </a>
                        </v-col>
                        <v-col class="d-flex pa-0 justify-content-between">
                            <v-col class="categories-block pa-0">
                                <a v-for="(category, i) in video.categories" :href="`/videos/` + category.slug"
                                   class="mr-2 font-italic" :key="i" target="_blank">
                                    {{ category.name }}
                                </a>
                            </v-col>
                            <v-col class="pa-0 text-end">
                                <a class="videos-id grey--text text-decoration-none" :href="'/' + video.post.id"
                                   target="_blank">
                                    #{{ video.post.id }}
                                </a>
                            </v-col>
                        </v-col>
                    </v-card-text>
                    <v-divider class="m-0 grey lighten-3"></v-divider>
                    <v-card-actions class="pa-0 px-1">
                        <div>
                            <v-btn @click="toggleLike()" icon>
                                <v-icon
                                    :class="[isLiked ? 'red--text text--lighten-1' : 'grey--text text--lighten-1']">
                                    mdi-heart
                                </v-icon>
                            </v-btn>
                            <span v-if="likesCount > 0">{{ likesCount }}</span>

                            <v-btn @click="toggleFavorite()" icon>
                                <v-icon
                                    :class="[isFavorite ? 'primary--text text--lighten-1' : 'grey--text text--lighten-1']">
                                    mdi-bookmark
                                </v-icon>
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
                        v-if="videoDialog" class="video-iframe pt-5" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""
                        :src="video.embeded_link"
                    ></iframe>
                </v-card-text>
            </v-card>
        </v-dialog>
    </v-card>
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
            user: window.Laravel.auth,
            newFavorite: false,
            newLike: false,
            likesCount: this.video.likes_count
        };
    },
    mounted() {
        this.newFavorite = this.video.favorites.some((like) => {
            return like?.user_id === this.user?.id;
        });

        this.newLike = this.video.likes.some((like) => {
            return like?.user_id === this.user?.id;
        });
    },
    computed: {
        isFavorite: {
            get() {
                if (this.user) {
                    return this.newFavorite
                }
            },
            set(newValue) {
                this.newFavorite = newValue;
            }
        },
        isLiked: {
            get() {
                if (this.user) {
                    return this.newLike
                }
            },
            set(newValue) {
                this.newLike = newValue;
            }
        }
    },
    methods: {
        toggleFavorite() {
            if (!this.user) {
                window.location.href = '/login';
                return;
            }

            const endpoint = this.isFavorite ? 'unfavorites' : 'favorites';

            axios.post(`/api/videos/${this.item.id}/${endpoint}`)
                .then(res => {
                    if (res.status === 200) {
                        this.isFavorite = !this.isFavorite;
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        },
        toggleLike() {
            if (!this.user) {
                window.location.href = '/login';
                return;
            }

            const endpoint = this.isLiked ? 'unlikes' : 'likes';

            axios.post(`/api/videos/${this.item.id}/${endpoint}`)
                .then(res => {
                    if (res.status === 200) {
                        this.isLiked = !this.isLiked;
                        this.likesCount += (endpoint === 'likes') ? 1 : (endpoint === 'unlikes') ? -1 : 0;
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
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
