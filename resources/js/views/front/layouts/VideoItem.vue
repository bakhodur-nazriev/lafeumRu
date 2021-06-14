<template>
    <div>
        <v-card flat rounded="lg" class="mb-6">
            <v-card-subtitle class="d-flex pb-0">
                <v-col cols="6" class="text-right">
                    <img class="img-thumbnail" :src="video.thumbnail"/>
                    <span class="video-duration-block">{{ video.duration + ':00' }}</span>
                </v-col>

                <v-col cols="6">
                    <h5 class="font-weight-regular title-videos ma-0">{{ video.title }}</h5>
                </v-col>
            </v-card-subtitle>

            <v-card-text class="px-7 py-3">
                <div class="mb-2">
                    <a
                        :href="`/channels/` + video.channel.slug"
                        class="h4 text-decoration-none font-weight-regular title-videos"
                    >
                        <v-icon size="34">mdi-youtube</v-icon>
                        {{ video.channel.name }}
                    </a>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="categories-block">
                        <a
                            class="grey--text text-decoration-none"
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
                <!--                        <div>-->
                <!--                            <v-btn icon>-->
                <!--                                <v-icon color="grey lighten-1"> mdi-heart</v-icon>-->
                <!--                            </v-btn>-->
                <!--                            <span>45</span>-->
                <!--                            <v-btn icon>-->
                <!--                                <v-icon color="grey lighten-1"> mdi-bookmark</v-icon>-->
                <!--                            </v-btn>-->
                <!--                            <span>45</span>-->
                <!--                        </div>-->
                <v-spacer></v-spacer>
                <share-button :post="item.post"></share-button>
            </v-card-actions>
        </v-card>

        <v-dialog
            v-model="dialog"
            width="700"
        >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    color="primary lighten-2"
                    dark
                    v-bind="attrs"
                    v-on="on"
                >
                    Click Me
                </v-btn>
            </template>

            <v-card>
                <v-card-title class="text-h6 grey lighten-2 d-flex justify-content-between">
                    <span>{{ video.title }}</span>
                    <v-btn icon @click="dialog = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-card-title>

                <v-card-text>
                    <iframe
                        class="video-iframe h-100 w-100"
                        :src="video.embeded_link + `?enablejsapi=1`"
                        frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""
                    ></iframe>
                </v-card-text>
            </v-card>
        </v-dialog>
    </div>
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
        };
    },
};
</script>

<style scoped>
.video-duration-block {
    font-size: 12px;
    background-color: black;
    color: white;
    border-radius: 10%;
    padding: 0 5px;
    font-weight: 600;
    position: absolute;
    right: 22px;
    bottom: 22px;
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
</style>
