<template>
    <v-col xl="5" lg="6" order="3" order-lg="2">
        <v-col class="px-1">
            <h5 class="text-uppercase font-weight-regular pb-3 mb-0">Цитаты и Афоризмы</h5>
            <p>
                Лучшие цитаты, афоризмы и высказывания великих ученых и мыслителей,
                и успешных людей на тематику сайта.
            </p>
        </v-col>
        <v-row align="center">
            <v-col
                cols="12"
                class="d-flex justify-center"
                v-if="loading"
            >
                <v-progress-circular
                    width="5"
                    size="48"
                    indeterminate
                    color="primary"
                ></v-progress-circular>
            </v-col>
            <v-col v-else>
                <quote-item
                    v-for="(quote, i) in quotes"
                    :quote="quote"
                    :key="i"
                >
                </quote-item>
            </v-col>
        </v-row>
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
import QuoteItem from "./layouts/QuoteItem";

export default {
    components: {QuoteItem},
    data() {
        return {
            quotes: [],
            loading: false,
            pagination: {
                current: Number(sessionStorage.getItem('current_quotes_page')),
                total: 0,
            },
        };
    },
    methods: {
        getQuotes() {
            this.loading = true;
            axios
                .get("/api/front/quotes?page=" + this.pagination.current)
                .then((res) => {
                    this.loading = false;
                    this.quotes = res.data.data;
                    sessionStorage.setItem('current_quotes_page', res.data.current_page);
                    this.pagination.current = Number(sessionStorage.getItem('current_quotes_page'));
                    this.pagination.total = res.data.last_page;
                })
                .catch((err) => {
                    this.loading = false;
                    console.log(err);
                });
        },
        onPageChange() {
            this.getQuotes();
            window.scrollTo(0, 0);
        },
    },
    mounted() {
        this.getQuotes();
    },
};
</script>

<style scoped>
.categories-block a:hover {
    color: #04718c !important;
}

button:focus {
    outline: none !important;
}
</style>
