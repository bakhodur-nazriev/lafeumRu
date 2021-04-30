<template>
    <v-card flat rounded="lg" class="mb-8">
        <v-card-subtitle class="d-flex px-6 pb-4 pt-6">
            <div class="mr-6">
                <iframe
                    class="video-iframe h-100"
                    :src="video.embeded_link"
                    frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen=""
                ></iframe>
            </div>

            <div>
                <h5 class="font-weight-regular title-color ma-0">{{ video.title }}</h5>
            </div>
        </v-card-subtitle>

        <v-card-text class="px-6 py-3">
            <div class="mb-2">
                <a
                    :href="`/channels/` + video.channel.slug"
                    class="h4 text-decoration-none font-weight-regular title-color"
                >
                    <v-icon size="34">mdi-youtube</v-icon>
                    {{ video.channel.name }}
                </a>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <a
                        class="mx-1 grey--text text-decoration-none"
                        v-for="(category, i) in video.categories"
                        :key="i"
                        :href="`/videos/` + category.slug"
                    >
                        {{ category.name }}
                    </a>
                </div>
                <div>
                    <a class="grey--text text-decoration-none" :href="video.post.id">
                        #{{ video.post.id }}
                    </a>
                </div>
            </div>
        </v-card-text>

        <v-divider class="m-0 grey lighten-3"></v-divider>

        <v-card-actions class="px-4 py-3">
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

<script>
import ShareButton from ""

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
</style>
