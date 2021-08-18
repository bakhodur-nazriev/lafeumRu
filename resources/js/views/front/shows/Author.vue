<template>
    <v-col xl="5" class="author-show-main-block">
        <div class="d-flex my-2">
            <div>
                <v-avatar style="float:left;" class="mr-7" size="100" v-if="currentAuthor.photo">
                    <img :src="currentAuthor.photo" :alt="currentAuthor.name"/>
                </v-avatar>
                <h3 class="blue--text">{{ currentAuthor.name }}</h3>
                <h5
                    class="author-biography text-lg-justify mb-0"
                    v-html="currentAuthor.biography"
                ></h5>
            </div>
        </div>
        <v-col cols="12" class="d-flex justify-center" v-if="loading">
            <v-progress-circular
                width="5"
                size="48"
                indeterminate
                color="primary"
            ></v-progress-circular>
        </v-col>
        <v-col v-else class="px-0">
            <quote-item
                v-for="(quote ,i) in currentAuthorQuotes"
                :key="i"
                :quote="quote"
            ></quote-item>
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
import QuoteItem from "../layouts/QuoteItem";

export default {
    name: "Author",
    components: {QuoteItem},
    data() {
        return {
            loading: false,
            windowUrl: window.location.pathname,
            currentAuthorQuotes: [],
            currentAuthor: [],
            pagination: {
                currentPage: 1,
                totalPage: 0
            }
        }
    },
    methods: {
        getAuthor() {
            this.loading = true;
            axios
                .get(`/api${this.windowUrl}?page=` + this.pagination.currentPage)
                .then((res) => {
                    this.loading = false;
                    this.currentAuthorQuotes = res.data[2].quotes.data;
                    this.pagination.currentPage = res.data[2].quotes.current_page;
                    this.pagination.totalPage = res.data[2].quotes.last_page;
                    this.currentAuthor = res.data[2];
                })
                .catch((err) => {
                    this.loading = false;
                    console.log(err);
                })
        },
        onPageChange() {
            this.getAuthor();
            window.scrollTo(0, 0);
        },
    },
    mounted() {
        this.getAuthor();
    },
};
</script>

<style scoped>
@media (min-width: 1904px) {
    .author-show-main-block {
        flex: 0 0 45%;
        max-width: 45%;
    }
}

.author-biography {
    font-weight: 400;
    font-size: 16px;
    line-height: 22px;
}
</style>
