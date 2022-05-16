<template>
    <v-col xl="5" order="3" order-lg="2">
        <h5 class="text-uppercase font-weight-regular py-2 mb-0">Каналы</h5>
        <v-col class="pa-1">
            <h3 class="blue--text">{{ currentChannel.name }}</h3>
            <h5 class="channel-description" v-html="currentChannel.description"></h5>
        </v-col>

        <v-col cols="12" class="d-flex justify-center" v-if="loading">
            <v-progress-circular
                width="5"
                size="48"
                indeterminate
                color="primary"
            ></v-progress-circular>
        </v-col>
        <v-col v-else class="pa-0">
            <video-item
                v-for="(video, i) in videosChannel"
                :key="i"
                :video="video"
            ></video-item>
        </v-col>
        <v-col cols="12">
            <v-pagination
                v-model="pagination.currentPage"
                :length="pagination.totalPage"
                :total-visible="7"
                @input="onPageChange"
            ></v-pagination>
        </v-col>
    </v-col>
</template>

<script>
export default {
    name: "Channel",
    data() {
        return {
            videosChannel: [],
            currentChannel: [],
            loading: false,
            windowUrl: window.location.pathname,
            pagination: {
                currentPage: 1,
                totalPage: 0
            }
        }
    },
    methods: {
        getChannels() {
            this.loading = true;
            axios
                .get(`/api/front${this.windowUrl}?page=` + this.pagination.currentPage)
                .then((res) => {
                    this.loading = false;
                    this.currentChannel = res.data[0];
                    this.videosChannel = res.data[0].videos.data;
                    this.pagination.currentPage = res.data[0].videos.current_page;
                    this.pagination.totalPage = res.data[0].videos.last_page;
                })
                .catch((err) => {
                    this.loading = false;
                    console.log(err);
                })
        },
        onPageChange() {
            this.getChannels();
            window.scrollTo(0, 0);
        }
    },
    mounted() {
        this.getChannels();
    }
}
</script>

<style scoped>
.channel-description {
    font-weight: 400;
    font-size: 16px;
    line-height: 22px;
}
</style>
