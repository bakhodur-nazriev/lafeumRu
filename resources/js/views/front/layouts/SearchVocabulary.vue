<template>
    <div>
        <v-row justify="center">
            <v-col
                v-for="(vocabulary, i) in filteredVocabulary"
                :key="i"
                class="fill-height col-md-6 col-12"
            >
                <v-card rounded="lg" class="px-7 py-5" flat>
                    <v-card-text
                        v-for="(term, i) in vocabulary"
                        :key="i"
                        class="pa-0"
                    >
                        <list-of-vocabulary :item="term"></list-of-vocabulary>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import ListOfVocabulary from "../ListOfChildren/ListOfVocabulary";

export default {
    components: {ListOfVocabulary},
    name: "SearchVocabulary",
    data() {
        return {
            cols: 2,
            page: 1,
            terms: [],
            search: "",
            widthOfWindow: window.innerWidth,
            path: `/api/front${window.location.pathname}`,
        }
    },
    methods: {
        searchVocabulary(value) {
            axios
                .get("/api/search-vocabulary?search=" + value)
                .then(res => {
                    this.terms = res.data.data;
                    this.$emit("clicked", false);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        clearVocabulary() {
            this.filteredVocabulary = this.terms;
        },
    },
    mounted() {
        // this.$emit("clicked", false);
        this.searchVocabulary();
    },
    watch: {
        search() {
            this.searchVocabulary(this.search);
        },
    },
    computed: {
        columns() {
            let columns = [];
            let mid = Math.ceil(this.terms.length / this.cols);

            if (this.widthOfWindow > 960) {
                for (let col = 0; col < this.cols; col++) {
                    columns.push(this.terms.slice(col * mid, col * mid + mid));
                }

                if (columns[0].length !== columns[1].length) {
                    columns[1].push({
                        id: columns[1].length + 1,
                        name: "",
                        post: {
                            id: columns[1].length + 1,
                        },
                    });
                }
            } else {
                columns.push(this.terms);
            }

            return columns;
        },
        filteredVocabulary: {
            get() {
                if (this.search) {
                    return this.columns.map(terms => {
                        return terms.filter(term => {
                            return term.name.toLowerCase().includes(this.search.toLowerCase());
                        });
                    });

                } else {
                    return this.columns;
                }
            },
            set(v) {
                this.terms = v;
            },
        },
    },
}
</script>

<style scoped>

</style>
