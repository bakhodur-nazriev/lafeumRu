<template>
    <v-col xl="5" lg="6" order="3" order-lg="2">
        <v-col class="pb-8">
            <h5 class="text-uppercase font-weight-regular mb-0">Термины</h5>
        </v-col>
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
                v-for="(term, i) in terms"
                :key="i"
                class="py-0"
                cols="12"
                v-else
            >
                <term-item :term="term"></term-item>
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

export default {
    name: "Terms",
    data() {
        return {
            loading: false,
            terms: [],
            pagination: {
                current: Number(sessionStorage.getItem('current_terms_page')),
                total: 0
            }
        }
    },
    methods: {
        getTerms() {
            this.loading = true;
            axios
                .get("/api/front/terms?page=" + this.pagination.current)
                .then(res => {
                    this.loading = false;
                    this.terms = res.data.data;
                    sessionStorage.setItem('current_terms_page', res.data.current_page);
                    this.pagination.current = Number(sessionStorage.getItem('current_terms_page'));
                    this.pagination.total = res.data.last_page;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err)
                })
        },
        onPageChange() {
            this.getTerms();
            window.scrollTo(0, 0);
        }
    },
    mounted() {
        this.getTerms();
    },
}
</script>

<style scoped>
</style>
