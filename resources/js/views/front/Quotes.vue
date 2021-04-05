<template>
    <v-col cols="5">
        <h5 class="text-uppercase font-weight-regular py-4 mx-4">Цитаты</h5>
        <v-card
            flat
            rounded="lg"
            class="mb-8"
            v-for="(quote , i) in quotes.data"
            :key="i"
        >
            <v-card-subtitle class="d-flex px-6 py-4">
                <v-spacer></v-spacer>
                <a
                    class="grey--text text-decoration-none"
                    :href="quote.post.id"
                >
                    #{{ quote.post.id }}
                </a>
            </v-card-subtitle>

            <v-divider class="m-0 grey lighten-3"></v-divider>

            <v-card-text class="px-6 py-3">
                <p class="subtitle-1">{{ quote.body }}</p>
                <div class="mb-2">
                    <a class="d-flex align-items-center text-decoration-none" :href="`/authors/` + quote.author.slug">
                        <v-icon color="grey lighten-1">mdi-account</v-icon>
                        <h5 class="mb-0 ml-1 black--text subtitle-1">{{ quote.author.name }}</h5>
                    </a>
                </div>
                <div class="categories-block">
                    <a
                        class="mx-1 grey--text text-decoration-none"
                        href=""
                        v-for="(category, i) in quote.categories"
                        :key="i"
                    >
                        {{ category.name }}
                    </a>
                </div>
            </v-card-text>
            <v-divider class="m-0 grey lighten-3"></v-divider>
            <v-card-actions class="px-4 py-3">
                <div>
                    <v-btn icon>
                        <v-icon color="grey lighten-1">
                            mdi-heart
                        </v-icon>
                    </v-btn>
                    <span>45</span>
                    <v-btn icon>
                        <v-icon color="grey lighten-1">
                            mdi-bookmark
                        </v-icon>
                    </v-btn>
                    <span>45</span>
                </div>

                <v-spacer></v-spacer>

                <div>
                    <v-btn icon color="grey lighten-1">
                        <v-icon>mdi-share-variant</v-icon>
                    </v-btn>
                </div>
            </v-card-actions>
        </v-card>
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
export default {
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
                    // console.log(res.data);
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

<style scoped>
.categories-block a:hover {
    color: #04718C !important;
}

button:focus {
    outline: none !important;
}
</style>
