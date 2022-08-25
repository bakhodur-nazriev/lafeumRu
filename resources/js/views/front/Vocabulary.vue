<template>
    <v-col xl="5" lg="6" class="px-4" order="3" order-lg="2">
        <div v-if="category.slug">
            <h3 class="pt-4 pb-2">{{ category.name }}</h3>
            <p>{{ category.description }}</p>
        </div>
        <v-col v-else class="pa-0">
            <p>
                На сегодня содержит более одной тысячи основных терминов,
                соответствующих тематике сайта. Для удобства термины
                дополнительно разбиты на темы. Большинство терминов взяты из
                Википедии с указанием ссылки на источник. В большинстве понятий
                имеются другие взаимосвязанные термины и ссылки. По мере
                обновления на основном источнике здесь они будут равным образом
                обновляться.
            </p>
        </v-col>

        <v-col cols="12" class="d-flex align-items-center px-0">
            <div class="form-search rounded-lg w-100">
                <v-text-field
                    solo
                    flat
                    dense
                    clearable
                    height="41"
                    hide-details
                    v-model="search"
                    placeholder="Введите термин"
                    background-color="transparent"
                    @click:clear="clearVocabulary()"
                    class="rounded-lg rounded-tr-0 rounded-br-0 search-filed"
                >
                </v-text-field>
                <v-btn
                    depressed
                    height="45"
                    color="primary"
                    class="text-capitalize rounded-0 rounded-br-lg rounded-tr-lg"
                >
                    Поиск
                </v-btn>
            </div>
        </v-col>

        <div v-if="search">
            <h5>Search</h5>
            <search-vocabulary
                :terms="filteredVocabulary"
                :getVocabulary="getVocabulary"
                @processingFinished="processingFinished"
            />
        </div>

        <div v-if="!search">
            <h5>All vocabulary</h5>
            <all-vocabulary
                :terms="filteredVocabulary"
                :getVocabulary="getVocabulary"
                @processingFinished="processingFinished"
            />
        </div>

    </v-col>
</template>

<script>
import AllVocabulary from "./layouts/AllVocabulary";
import SearchVocabulary from "./layouts/SearchVocabulary";
import InfiniteLoading from "vue-infinite-loading";

export default {
    components: {
        AllVocabulary,
        SearchVocabulary,
        InfiniteLoading
    },
    data() {
        return {
            cols: 2,
            page: 1,
            terms: [],
            search: "",
            category: [],
            isSearching: false,
            widthOfWindow: window.innerWidth,
            path: `/api/front${window.location.pathname}`,
        };
    },
    methods: {
        getVocabulary($state) {
            let url = this.path ? this.path : "/api/front/vocabulary";
            axios
                .get(url + "?page=" + this.page)
                .then(res => {
                    if (res.data.data.length || res.data.length) {
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

        searchVocabulary(value) {
            axios
                .get("/api/search-vocabulary?search=" + value)
                .then(res => {
                    this.$emit('processingFinished', false);
                    this.terms = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        clearVocabulary() {
            this.filteredVocabulary = this.terms;
        },
        processingFinished(value) {
            this.isSearching = value;
        }
    },
    mounted() {
        this.searchVocabulary();
        this.getVocabulary();
        this.$emit('processingFinished', false);
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
};
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
