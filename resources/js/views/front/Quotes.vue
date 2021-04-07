<template>
    <v-col cols="5">
        <h5 class="text-uppercase font-weight-regular py-4 mx-4">Цитаты</h5>
        <v-row align="center">
            <v-col cols="12" class="d-flex justify-center" v-if="loading">
                <h5 class="text-uppercase font-weight-regular py-4">загурзка...</h5>
            </v-col>
            <v-col v-else class="py-0">
                <quote-item
                    v-for="(quote ,i) in quotes.data"
                    :key="i"
                    :quote="quote"
                >
                </quote-item>
            </v-col>
        </v-row>
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
                class="ova"
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
    components: {
        QuoteItem
    },
    data() {
        return {
            quotes: {},
            loading: false,
            pagination: {
                current: 1,
                total: 0
            },
        };
    },
    methods: {
        getQuotes() {
            this.loading = true;
            axios
                .get("/api/quotes?page=" + this.pagination.current)
                .then(res => {
                    this.loading = false;
                    this.quotes = res.data;
                    this.pagination.current = res.data.current_page;
                    this.pagination.total = res.data.last_page;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err)
                })
        },
        onPageChange() {
            this.getQuotes();
        }
    },
    mounted() {
        this.getQuotes();
    }
};
</script>

<style>
.categories-block a:hover {
    color: #04718C !important;
}

button:focus {
    outline: none !important;
}
</style>
