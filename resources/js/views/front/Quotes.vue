<template>
    <v-col xl="5" lg="6">
        <h5 class="text-uppercase font-weight-regular py-4 mx-4">Цитаты</h5>
        <v-row align="center">
            <v-col cols="12" class="d-flex justify-center" v-if="loading">
                <v-progress-circular
                    width="5"
                    size="48"
                    indeterminate
                    color="primary"
                ></v-progress-circular>
            </v-col>
            <v-col v-else class="py-0">
                <quote-item
                    v-for="(quote, i) in quotes.data"
                    :key="i"
                    :quote="quote"
                >
                </quote-item>
            </v-col>
        </v-row>
        <v-col cols="12" id="lol">
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
import QuoteItem from "./layouts/QuoteItem";
import Scroller from "../../components/Scroller";

export default {
    props: ["categories", "item"],
    components: {
        QuoteItem,
        Scroller
    },
    data() {
        return {
            quotes: {},
            loading: false,
            pagination: {
                current: 1,
                total: 0,
            },
            test: this.item,
        };
    },
    methods: {
        getQuotes() {
            this.loading = true;
            axios
                .get("/api/quotes?page=" + this.pagination.current)
                .then((res) => {
                    this.loading = false;
                    this.quotes = res.data;
                    this.pagination.current = res.data.current_page;
                    this.pagination.total = res.data.last_page;
                })
                .catch((err) => {
                    this.loading = false;
                    console.log(err);
                });
        },
        onPageChange() {
            this.getQuotes();
        },
    },
    mounted() {
        this.getQuotes();
    },
};
</script>

<style>
.categories-block a:hover {
    color: #04718c !important;
}

button:focus {
    outline: none !important;
}
</style>
