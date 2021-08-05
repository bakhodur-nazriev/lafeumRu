<template>
    <v-col xl="5" lg="6" class="main-videos-block">
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
                v-for="(video, i) in videos.data"
                :key="i"
                :video="video"
            />
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
            videoDialog: false,
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
        },
    },
    mounted() {
        this.getVideos();
    }
}
</script>

<style scoped>
@media (min-width: 1904px) {
    .main-videos-block {
        flex: 0 0 45%;
        max-width: 45%;
    }
}
</style>
