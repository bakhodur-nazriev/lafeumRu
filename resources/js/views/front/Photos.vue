<template>
    <v-col xl="10" lg="12">
        <h5 class="text-uppercase font-weight-regular py-4 px-0 mb-0">фотографии</h5>
        <v-row align="center">
            <v-col cols="12" class="d-flex justify-center" v-if="loading">
                <v-progress-circular
                    width="5"
                    size="48"
                    indeterminate
                    color="primary"
                ></v-progress-circular>
            </v-col>

            <v-col
                class="d-flex justify-center col-md-3"
                v-for="(photo, i) in photos"
                :key="i"
                v-else
            >
                <list-of-photo :item="photo"></list-of-photo>
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
import ListOfPhoto from "./ListOfChildren/ListOfPhoto";

export default {
    components: {ListOfPhoto},
    data() {
        return {
            photos: [],
            loading: false,
            pagination: {
                current: Number(sessionStorage.getItem('current_photos_page')),
                total: 0
            },
        };
    },
    methods: {
        getAllPhotos() {
            this.loading = true;
            axios
                .get("/api/front/photos?page=" + this.pagination.current)
                .then(res => {
                    this.loading = false;
                    this.photos = res.data.data;
                    sessionStorage.setItem('current_photos_page', res.data.current_page);
                    this.pagination.current = Number(sessionStorage.getItem('current_photos_page'));
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

<style scoped>
</style>
