<template>
    <v-col xl="5" lg="6">
        <h5 class="text-uppercase font-weight-regular py-4 mx-4">{{ quotesCategory.name }}</h5>
        <p>{{ quotesCategory.description }}</p>
    </v-col>
</template>

<script>
export default {
    name: "Category",
    data() {
        return {
            loading: false,
            quotesCategory: [],
            termsCategory: [],
            videosCategory: [],
            vocabularyCategory: [],

        }
    },
    methods: {
        getCategoryQuotes() {
            this.loading = true;
            axios
                .get("/api/quotes/")
                .then(res => {
                    this.loading = false;
                    this.quotesCategory = res.data;
                    console.log(res.data);
                })
                .catch(err => {
                    console.log(err)
                })
        },
        getCategoryTerms() {
            this.loading = true;
            axios
                .get("/api/terms")
                .then(res => {
                    this.loading = false;
                })
                .catch(err => {
                    console.log(err)
                })
        },
        getCategoryVideos() {
            this.loading = true;
            axios
                .get("/api/videos")
                .then(res => {
                    this.loading = false;
                })
                .catch(err => {
                    console.log(err)
                })
        },
        getCategoryVocabulary() {
            this.loading = true;
            axios
                .get("/api/vocabulary")
                .then(res => {
                    this.loading = false;
                })
                .catch(err => {
                    console.log(err)
                })
        }
    },
    mounted() {
        this.getCategoryQuotes();
        this.getCategoryTerms();
        this.getCategoryVideos();
        this.getCategoryVocabulary();
    }
}
</script>

<style scoped>

</style>
