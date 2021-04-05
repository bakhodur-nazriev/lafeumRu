<template>
    <v-col cols="5">
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
                <v-card-subtitle class="d-flex px-6 py-4">
                    <iframe
                        class="video-iframe"
                        :src="video.embeded_link"
                        frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""
                    ></iframe>
                    <v-spacer></v-spacer>
                    <h4 class="font-weight-regular title-color">{{ video.title }}</h4>
                </v-card-subtitle>

                <v-card-text class="px-6 py-3">
                    <div class="mb-2 d-flex justify-content-between">
                        <a
                            :href="`/channels/`+ video.channel.slug"
                            class="h4 text-decoration-none font-weight-regular title-color"
                        >
                            <v-icon size="34">mdi-youtube</v-icon>
                            {{ video.channel.name }}
                        </a>
                        <a class="grey--text text-decoration-none" :href="video.post.id">
                            #{{ video.post.id }}
                        </a>
                    </div>
                    <div class="categories-block">
                        <a
                            class="mx-1 grey--text text-decoration-none"
                            href=""
                            v-for="(category, i) in video.categories"
                            :key="i"
                        >
                            {{ category.name }}
                        </a>
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
