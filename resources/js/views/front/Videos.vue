<template>
    <v-col xl="5" lg="6" order="3" order-lg="2">
        <h5 class="text-uppercase font-weight-regular py-4 mb-0">Видео</h5>
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
                current: Number(sessionStorage.getItem('current_videos_page')),
                total: 0
            }
        }
    },
    methods: {
        getVideos() {
            this.loading = true;
            axios
                .get("/api/front/videos?page=" + this.pagination.current)
                .then((res) => {
                    this.loading = false;
                    this.videos = res.data;
                    sessionStorage.setItem('current_videos_page', res.data.current_page);
                    this.pagination.current = Number(sessionStorage.getItem('current_videos_page'));
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
</style>
