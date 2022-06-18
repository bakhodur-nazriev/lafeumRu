<template>
    <v-col xl="5" lg="6" class="px-4" order="3" order-lg="2">
        <div v-if="category.slug">
            <h3 class="pt-4 pb-2">{{ category.name }}</h3>
            <p>{{ category.description }}</p>
        </div>
        <v-col v-else class="pa-0">
            <p>
                На сегодня содержит более одной тысячи основных терминов,
                соответствующих тематике сайта. Для удобства термины дополнительно
                разбиты на темы. Большинство терминов взяты из Википедии с указанием
                ссылки на источник. В большинстве понятий имеются другие взаимосвязанные
                термины и ссылки. По мере обновления на основном источнике здесь они
                будут равным образом обновляться.
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

        <v-col cols="12" class="d-flex justify-center" v-if="loading">
            <v-progress-circular
                width="5"
                size="48"
                indeterminate
                color="primary"
            ></v-progress-circular>
        </v-col>
        <v-row v-else justify="center">
            <v-col
                v-for="(vocabulary, i) in filteredVocabulary"
                :key="i"
                class="fill-height col-md-6 col-12"
            >
                <v-card rounded="lg" class="px-7 py-5" flat>
                    <v-card-text
                        v-for="(term ,i) in vocabulary"
                        :key="i"
                        class="pa-0"
                    >
                        <list-of-vocabulary :item="term"></list-of-vocabulary>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-col>
</template>

<script>
import ListOfVocabulary from "./ListOfChildren/ListOfVocabulary";

export default {
    components: {
        ListOfVocabulary,
    },
    data() {
        return {
            cols: 2,
            search: "",
            loading: false,
            terms: [],
            category: [],
            widthOfWindow: window.innerWidth,
            path: `/api/front${window.location.pathname}`
        };
    },
    methods: {
        getVocabulary() {
            this.loading = true;
            let url = this.path ? this.path : '/api/front/vocabulary';
            axios
                .get(url)
                .then((res) => {
                    this.loading = false;
                    this.terms = res.data;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err);
                })
        },
        clearVocabulary() {
            this.filteredVocabulary = this.terms;
        },
    },
    mounted() {
        this.getVocabulary();
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
                        }
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
                    return this.columns.map((terms) => {
                        return terms.map((term) => {
                            const children = term.children.filter((child) => {
                                return (child.name.toLowerCase().includes(this.search.toLowerCase()) || this.search.includes(child.name));
                            });
                            return {...term, children};
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
