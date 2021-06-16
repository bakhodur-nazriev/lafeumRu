<template>
    <v-col xl="5" lg="6">
        <h5 class="text-uppercase font-weight-regular py-4 mx-4 mb-2">Видео</h5>
        <v-col cols="12" v-if="loading" class="d-flex justify-center">
            <v-progress-circular
                width="5"
                size="48"
                indeterminate
                color="primary"
            ></v-progress-circular>
        </v-col>
        <v-col cols="12" v-else class="pa-0">
            <video-item
                v-for="(video,i) in videos.data"
                :key="i"
                :video="video"
            ></video-item>
        </v-col>
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


        <!--        <v-dialog-->
        <!--            v-model="dialog"-->
        <!--            width="700"-->
        <!--        >-->
        <!--            <template v-slot:activator="{ on, attrs }">-->
        <!--                <v-btn-->
        <!--                    color="primary lighten-2"-->
        <!--                    dark-->
        <!--                    v-bind="attrs"-->
        <!--                    v-on="on"-->
        <!--                >-->
        <!--                    Click Me-->
        <!--                </v-btn>-->
        <!--            </template>-->

        <!--            <v-card>-->
        <!--                <v-card-title class="text-h6 grey lighten-2 d-flex justify-content-between">-->
        <!--                    <span>{{ video.title }}</span>-->
        <!--                    <v-btn icon @click="dialog = false">-->
        <!--                        <v-icon>mdi-close</v-icon>-->
        <!--                    </v-btn>-->
        <!--                </v-card-title>-->

        <!--                <v-card-text>-->
        <!--                    <iframe-->
        <!--                        class="video-iframe h-100 w-100"-->
        <!--                        :src="video.embeded_link + `?enablejsapi=1`"-->
        <!--                        frameborder="0"-->
        <!--                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"-->
        <!--                        allowfullscreen=""-->
        <!--                    ></iframe>-->
        <!--                </v-card-text>-->
        <!--            </v-card>-->
        <!--        </v-dialog>-->

    </v-col>
</template>

<script>

export default {
    name: "Videos",
    data() {
        return {
            videos: [],
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
                .then((res) => {
                    this.loading = false;
                    this.videos = res.data;
                    this.pagination.current = res.data.current_page;
                    this.pagination.total = res.data.last_page;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err);
                })
        },
        onPageChange() {
            this.getVideos();
            window.scrollTo(0, 0);
        }
    },
    mounted() {
        this.getVideos();
    }
}
</script>

<style scoped>
</style>
