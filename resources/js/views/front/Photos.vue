<template>
    <v-col cols="8">
        <v-row>
            <v-col cols="4">
                <v-card
                    elevation="0"
                    width="367"
                    height="264"
                    rounded="lg"
                >
                    <v-card-text class="d-flex justify-content-center align-items-center h-100">
                        <v-img max-width="268" height="180" class="d-flex" src=""></v-img>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>

        <v-btn class="btn" fab small elevation="0" rounded color="grey lighten-2">
            <v-icon color="white">mdi-arrow-down</v-icon>
        </v-btn>
        <!--<v-pagination>{{ allPhotos.links() }}</v-pagination>-->
    </v-col>
</template>

<script>
export default {
    data() {
        return {
            photos: {}

        };
    },
    mounted() {
        this.getAllPhotos();
    },
    methods: {
        getAllPhotos() {
            axios
                .get("/photo")
                .then(res => (this.lol = res.data))
                .catch(err => console.log(err))
        }
    },
    created() {
        console.log(this.getAllPhotos());
    }
};
</script>

<style scoped="scoped">
.btn:active {
    border: none;
}
</style>
