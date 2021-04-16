<template>
    <v-col xl="5" lg="6">
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
                <term-item :term="term"></term-item>
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
