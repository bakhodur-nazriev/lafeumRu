<template>
    <v-col xl="5" lg="6">
        <h5 class="text-uppercase font-weight-regular py-4 mx-4 mb-0">Видео</h5>
        <v-col cols="12" v-if="loading" class="d-flex justify-center">
            <v-progress-circular
                width="5"
                size="48"
                indeterminate
                color="primary"
            ></v-progress-circular>
        </v-col>
        <v-col cols="12" v-else>
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
        <scroller></scroller>
    </v-col>
</template>

<script>
import Scroller from "../../components/Scroller";

export default {
    name: "Videos",
    components: {Scroller},
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
