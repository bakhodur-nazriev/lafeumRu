<template>
    <v-col cols="8">
        <h5 class="text-uppercase font-weight-regular py-4">фотографии</h5>
        <v-row align="center">
            <v-col cols="12" class="d-flex justify-center" v-if="loading">
                <h5 class="text-uppercase font-weight-regular py-4">загурзка...</h5>
            </v-col>
            <v-col
                v-else
                cols="4"
                v-for="(photo, i) in photos"
                :key="i"
            >
                <v-card
                    flat
                    width="367"
                    height="264"
                    rounded="lg"
                >
                    <v-card-text class="d-flex justify-content-center align-items-center h-100">
                        <v-img max-width="268" height="180" class="d-flex" :src="photo.path"></v-img>
                    </v-card-text>
                </v-card>
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
        </v-row>
    </v-col>
</template>

<script>
export default {
    data() {
        return {
            photos: {},
            loading: false,
            pagination: {
                current: 1,
                total: 0
            },
        };
    },
    methods: {
        getAllPhotos() {
            this.loading = true;
            axios
                .get("/api/photos?page=" + this.pagination.current)
                .then(res => {
                    this.loading = false;
                    this.photos = res.data.data;
                    this.pagination.current = res.data.current_page;
                    this.pagination.total = res.data.last_page;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err)
                })
        },
        onPageChange() {
            this.getAllPhotos();
        }
    },
    mounted() {
        this.getAllPhotos();
    }
};
</script>

<style scoped="scoped">
.btn:active {
    border: none;
}
</style>
