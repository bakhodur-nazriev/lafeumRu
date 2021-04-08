<template>
    <v-col xl="5" lg="6">
        <h5 class="text-uppercase font-weight-regular py-4 mx-4">Видео</h5>
        <div v-if="loading" class="d-flex justify-center">
            <h5 class="text-uppercase font-weight-regular py-4">загурзка...</h5>
        </div>
        <div v-else>
            <v-card
                flat
                rounded="lg"
                class="mb-8"
                v-for="(video, i) in videos.data"
                :key="i"
            >
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
                            :href="`/channels/`+ video.channel.slug"
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
                                href=""
                                v-for="(category, i) in video.categories"
                                :key="i"
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
                            <v-icon color="grey lighten-1">
                                mdi-heart
                            </v-icon>
                        </v-btn>
                        <span>45</span>
                        <v-btn icon>
                            <v-icon color="grey lighten-1">
                                mdi-bookmark
                            </v-icon>
                        </v-btn>
                        <span>45</span>
                    </div>

                    <v-spacer></v-spacer>

                    <div>
                        <v-btn icon color="grey lighten-1">
                            <v-icon>mdi-share-variant</v-icon>
                        </v-btn>
                    </div>
                </v-card-actions>
            </v-card>
        </div>
        <v-col cols="12" class="d-flex justify-center mt-2">
            <v-btn
                fab
                small
                rounded
                elevation="0"
                color="grey lighten-2"
            >
                <v-icon color="white">mdi-arrow-down</v-icon>
            </v-btn>
        </v-col>
        <v-col cols="12">
            <v-pagination
                v-model="pagination.current"
                :length="pagination.total"
                :total-visible="7"
                @input="onPageChange"
            ></v-pagination>
        </v-col>
    </v-col>
</template>

<script>

export default {
    name: "Videos",
    data() {
        return {
            videos: {},
            loading: false,
            pagination: {
                current: 1,
                total: 0
            }
        }
    },
    methods: {
        getVideos() {
            this.loading = true;
            axios
                .get("/api/videos?page=" + this.pagination.current)
                .then(res => {
                    this.loading = false;
                    this.videos = res.data;
                    this.pagination.current = res.data.current_page;
                    this.pagination.total = res.data.last_page;
                    // console.log(res.data.data);
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err);
                })
        },
        onPageChange() {
            this.getVideos();
        }
    },
    mounted() {
        this.getVideos();
    }
}
</script>

<style scoped>
.title-color {
    color: #000;
}
</style>
