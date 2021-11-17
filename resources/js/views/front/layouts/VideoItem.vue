<template>
    <v-dialog
        v-model="videoDialog"
        width="900"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-card flat rounded="lg" class="mb-6">
                <v-card-subtitle class="d-md-flex pb-0">
                    <v-col
                        class="text-right pb-0 col-md-6 col-12"
                        v-bind="attrs"
                        v-on="on"
                    >
                        <img class="img-thumbnail" :src="video.thumbnail" :alt="video.title"/>
                        <span class="video-duration-block">{{ video.duration + ':00' }}</span>
                    </v-col>

                    <v-col class="pb-0 col-md-6 col-12">
                        <h5
                            class="grey--text text--darken-3 title-videos text-justify ma-0"
                            v-bind="attrs"
                            v-on="on"
                        >{{ video.title }}</h5>
                    </v-col>
                </v-card-subtitle>

                <v-card-text class="px-7 py-3">
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
                                class="text-decoration-none ml-1"
                                :key="i"
                                target="_blank"
                            >
                                {{ category.name }}
                            </a>
                        </v-col>
                        <div class="videos-slug">
                            <a
                                class="grey--text text--darken-3 text-decoration-none"
                                :href="'/' + video.post.id"
                                target="_blank"
                            >
                                #{{ video.post.id }}
                            </a>
                        </div>
                    </v-col>
                </v-card-text>

                <v-divider class="m-0 grey lighten-3"></v-divider>

                <v-card-actions style="padding: 2px 4px 3px 4px;">
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

.videos-slug > *:hover {
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
    line-height: 1.3;
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
