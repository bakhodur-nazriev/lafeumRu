<template>
    <v-col cols="5">
        <h5 class="text-uppercase font-weight-regular py-4 mx-4">Термины</h5>
        <v-row align="center">
            <v-col cols="12" class="d-flex justify-center" v-if="loading">
                <h5 class="text-uppercase font-weight-regular py-4">загурзка...</h5>
            </v-col>
            <v-col
                v-else
                class="py-0"
                cols="12"
                v-for="(term, i) in terms.data"
                :key="i"
            >
                <v-card
                    flat
                    rounded="lg"
                    class="mb-8"
                >
                    <v-card-subtitle class="d-flex p-4">
                        <div class="d-flex" v-if="term.term_type.name === `Термины научного мира`">
                            <v-img
                                v-for="icon in 3"
                                :key="icon"
                                src="/img/icons/atom.svg"
                                width="20"
                                class="mr-1"
                            >

                            </v-img>
                        </div>
                        <div v-else>
                            <span>{{ term.term_type.name }}</span>
                        </div>

                        <v-spacer></v-spacer>

                        <a
                            class="grey--text text-decoration-none"
                            :href="term.post.id"
                        >
                            #{{ term.post.id }}
                        </a>
                    </v-card-subtitle>

                    <v-divider class="m-0 grey lighten-3"></v-divider>

                    <v-card-text class="p-4">
                        <p class="subtitle-1" v-html="term.body"></p>
                        <div class="categories-block">
                            <a
                                class="mx-1 grey--text text-decoration-none"
                                v-for="(termCategories ,i) in term.categories"
                                :key="i"
                                :href="`/quotes/` + termCategories.slug"
                            >{{ termCategories.name }}</a>
                        </div>
                    </v-card-text>

                    <v-divider class="m-0 grey lighten-3"></v-divider>

                    <v-card-actions class="px-5 py-4">
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
export default {
    name: "Terms",
    data() {
        return {
            loading: false,
            terms: {},
            pagination: {
                current: 1,
                total: 0
            }
        }
    },
    methods: {
        getTerms() {
            this.loading = true;
            axios
                .get("/api/terms?page=" + this.pagination.current)
                .then(res => {
                    this.loading = false;
                    this.terms = res.data;
                    this.pagination.current = res.data.current_page;
                    this.pagination.total = res.data.last_page;
                    console.log(res.data);
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err)
                })
        },
        onPageChange() {
            this.getTerms();
        }
    },
    mounted() {
        this.getTerms();
    }
}
</script>

<style scoped>

</style>
