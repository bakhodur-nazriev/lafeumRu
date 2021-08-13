<template>
    <v-col xl="5" lg="5" md="6" class="terms-main-block ">
        <div class="py-4">
            <h5 class="text-uppercase font-weight-regular">Термины</h5>
        </div>
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
                    this.terms = res.data.data;
                    this.pagination.current = res.data.current_page;
                    this.pagination.total = res.data.last_page;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err)
                })
        },
        onPageChange() {
            window.scrollTo(0, 0);
            this.getTerms();
        }
    },
    mounted() {
        this.getTerms();
    },
}
</script>

<style scoped>
@media (max-width: 1904px) {
    .terms-main-block {
        flex: 0 0 53%;
        max-width: 53%;
    }
}

@media (min-width: 1904px) {
    .terms-main-block {
        flex: 0 0 45%;
        max-width: 45%;
    }
}
</style>
