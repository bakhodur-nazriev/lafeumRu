<template>
    <v-dialog
        v-model="videoDialog"
        width="900"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-card flat rounded="lg" class="mb-6">
                <v-card-subtitle class="d-flex pb-0">
                    <v-col
                        cols="6"
                        class="text-right pb-0"
                        v-bind="attrs"
                        v-on="on"
                    >
                        <img class="img-thumbnail" :src="video.thumbnail"/>
                        <span class="video-duration-block">{{ video.duration + ':00' }}</span>
                    </v-col>

                    <v-col cols="6" class="pb-0">
                        <h5
                            class="font-weight-regular title-videos ma-0"
                            v-bind="attrs"
                            v-on="on"
                        >{{ video.title }}</h5>
                    </v-col>
                </v-card-subtitle>

                <v-card-text class="px-7 py-3">
                    <div>
                        <a
                            :href="`/channels/` + video.channel.slug"
                            class="channels-links"
                        >
                            <v-icon size="34" class="mr-1">mdi-youtube</v-icon>
                            <span>{{ video.channel.name }}</span>
                        </a>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="categories-block">
                            <a
                                class="grey--text text-decoration-none ml-1"
                                v-for="(category, i) in video.categories"
                                :key="i"
                                :href="`/videos/` + category.slug"
                            >
                                {{ category.name }}
                            </a>
                        </div>
                        <div>
                            <a class="grey--text text-decoration-none" :href="'/' + video.post.id">
                                #{{ video.post.id }}
                            </a>
                        </div>
                    </div>
                </v-card-text>

                <v-divider class="m-0 grey lighten-3"></v-divider>

                <v-card-actions class="px-4 py-2">
                    <div>
                        <v-btn icon>
                            <v-icon color="grey lighten-1"> mdi-heart</v-icon>
                        </v-btn>
                        <span>45</span>
                        <v-btn icon>
                            <v-icon color="grey lighten-1"> mdi-bookmark</v-icon>
                        </v-btn>
                        <span>45</span>
                    </div>
                    <v-spacer></v-spacer>
                    <share-button :post="item.post"></share-button>
                </v-card-actions>
            </v-card>
        </template>

        <v-card>
            <v-card-title class="title grey lighten-2 py-3 px-4">
                <span>{{ video.title }}</span>
                <v-spacer></v-spacer>
                <v-btn icon @click="videoDialog = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </v-card-title>

            <v-card-text>
                <iframe
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
            videoDialog: false
        };
    },
};
</script>

<style scoped>
.video-iframe {
    width: 100%;
    height: 50vh;
}

.video-duration-block {
    font-size: 12px;
    background-color: black;
    color: white;
    border-radius: 10%;
    padding: 0 5px;
    font-weight: 600;
    position: absolute;
    right: 20px;
    bottom: 8px;
}

.img-thumbnail {
    width: 100%;
    height: 200px;
    padding: .25rem;
    background-color: #f8fafc;
    border: 1px solid #dee2e6;
    border-radius: .25rem;
}

.title-videos {
    line-height: normal;
}

.channels-links {
    display: flex;
    align-items: center;
    font-weight: normal;
    line-height: normal;
    width: fit-content;
    text-decoration: none;
    font-size: 20px;
}
</style>
