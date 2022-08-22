<template>
    <div>
        <v-row justify="center" class="px-0">
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
        <infinite-loading @disance="1" @infinite="getVocabulary">
            <div slot="no-results"></div>
            <div slot="no-more"></div>
        </infinite-loading>
    </div>
</template>

<script>
import ListOfVocabulary from "../ListOfChildren/ListOfVocabulary";
import InfiniteLoading from "vue-infinite-loading";

export default {
    components: {ListOfVocabulary, InfiniteLoading},
    name: "allVocabulary",
    props: ['filteredVocabulary'],
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
        getVocabulary($state) {
            let url = this.path ? this.path : "/api/front/vocabulary";
            axios
                .get(url + "?page=" + this.page)
                .then(res => {
                    if (res.data.data.length || res.data.length) {
                        this.$emit('processingFinished', false);
                        this.page += 1;
                        this.terms.push(...res.data.data);
                        $state.loaded();

                    } else {
                        $state.complete();
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
            this.page += 1;
        },
    },
    mounted() {
        this.getVocabulary();
    },

    // computed: {
    //     columns() {
    //         let columns = [];
    //         let mid = Math.ceil(this.terms.length / this.cols);
    //
    //         if (this.widthOfWindow > 960) {
    //             for (let col = 0; col < this.cols; col++) {
    //                 columns.push(this.terms.slice(col * mid, col * mid + mid));
    //             }
    //
    //             if (columns[0].length !== columns[1].length) {
    //                 columns[1].push({
    //                     id: columns[1].length + 1,
    //                     name: "",
    //                     post: {
    //                         id: columns[1].length + 1,
    //                     },
    //                 });
    //             }
    //         } else {
    //             columns.push(this.terms);
    //         }
    //
    //         return columns;
    //     },
    //     filteredVocabulary: {
    //         get() {
    //             if (this.search) {
    //                 this.$emit("processingFinished", true);
    //                 return this.columns.map(terms => {
    //                     return terms.filter(term => {
    //                         return term.name.toLowerCase().includes(this.search.toLowerCase());
    //                     });
    //                 });
    //
    //             } else {
    //                 return this.columns;
    //             }
    //         },
    //         set(v) {
    //             this.terms = v;
    //         },
    //     },
    // },
}
</script>

<style scoped>
.form-search {
    display: flex;
}

.search-filed {
    border: 2px solid #9b9b9b;
    border-right: none;
}
</style>
