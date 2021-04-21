<template>
    <v-col xl="5" lg="6" class="px-7">
        <h5 class="text-uppercase font-weight-regular py-4">Словарь «ЛАФЕЮМ»</h5>
        <p class="grey--text">
            На сегодня содержит более одной тысячи основных терминов, соответствующих
            тематике сайта. Для удобства термины дополнительно разбиты на темы.
            Большинство терминов взяты из Википедии с указанием ссылки на источник. В
            большинстве понятий имеются другие взаимосвязанные термины и ссылки. По
            мере обновления на основном источнике здесь они будут равным образом
            обновляться.
        </p>

        <v-col cols="12" class="d-flex align-items-center pl-0 mb-5">
            <div class="form-search rounded-lg w-100">
                <v-text-field
                    solo
                    flat
                    clearable
                    height="48"
                    hide-details
                    v-model="search"
                    placeholder="Область знаний"
                    background-color="transparent"
                    class="rounded-lg rounded-tr-0 rounded-br-0 search-filed"
                >
                </v-text-field>
                <v-btn
                    depressed
                    height="52"
                    color="primary"
                    class="text-capitalize rounded-0 rounded-br-lg rounded-tr-lg"
                >
                    Поиск
                </v-btn>
            </div>
        </v-col>
        <v-col cols="12" class="mb-5">
            <h5 class="subtitle-1">
                Примеры информативных поисковых запросов: «нау», «логия», «ика», «изм»,
                «фило», «само», «чело», «соц», «пси», «эво» и т.п.
            </h5>
        </v-col>

        <h5 class="text-uppercase font-weight-regular">все слова</h5>
        <v-col cols="12" class="d-flex justify-center" v-if="loading">
            <h5 class="text-uppercase font-weight-regular py-4">загурзка...</h5>
        </v-col>

        <v-row justify="center" v-else>
            <v-col cols="6" v-for="(vocabulary, i) in columns" :key="i">
                <v-card rounded="lg" class="px-8 py-5" flat>
                    <v-card-text class="pa-1" v-for="(term ,i) in vocabulary" :key="i">
                        <h1 class="vocabulary-letter text-decoration-none pt-4 pb-2">{{ term.group }}</h1>
                        <div class="truncate-to-seven-line">
                            <div
                                class="pb-1"
                                v-for="(child ,i) in term.children"
                                :key="i"
                            >
                                <a
                                    class="vocabulary-words text-decoration-none"
                                >
                                    {{ child.name }}
                                </a>
                                <br/>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="#" class="font-italic">Еще.</a>
                        </div>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-col cols="12" class="text-center my-5">
            <v-btn large class="grey lighten-1" icon>
                <v-icon color="white">mdi-arrow-down</v-icon>
            </v-btn>
        </v-col>
    </v-col>
</template>

<script>
export default {
    data() {
        return {
            search: "",
            terms: [],
            loading: false,
            page: 0,
            cols: 2
        };
    },
    methods: {
        getVocabulary() {
            this.loading = true;
            axios
                .get("/api/vocabulary")
                .then(res => {
                    this.loading = false;
                    this.terms = res.data;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err)
                })
        }
    },
    mounted() {
        this.getVocabulary();
    },
    computed: {
        orderVocabulary() {
            let allTerms = this.terms.reduce((r, e) => {
                let group = e.name[0];
                if (!r[group]) r[group] = {group, children: [e]}
                else r[group].children.push(e);
                return r;
            }, {})
            return Object.values(allTerms);
        },
        filteredVocabulary() {
            return this.orderVocabulary.map(terms => {
                const children = terms.children.filter(term => {
                    // return term.name.toLowerCase().includes(this.search.toLowerCase()) || this.search.includes(child.name);
                    console.log(this.columns);
                });
                // return {...terms, children}
            });
        },
        columns() {
            let columns = [];
            let mid = Math.ceil(this.orderVocabulary.length / this.cols);
            for (let col = 0; col < this.cols; col++) {
                columns.push(this.orderVocabulary.slice(col * mid, col * mid + mid));
            }
            return columns;
        },
    },
};
</script>

<style scoped>
.form-search {
    display: flex;
}

.search-filed {
    border: 2px solid #1a718c;
}

.truncate-to-seven-line {
    padding: 0;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 7;
    -webkit-box-orient: vertical;
}

.vocabulary-letter {
    color: #494949;
}

.vocabulary-words {
    color: #494949;
}

.vocabulary-words:hover {
    color: #1a718c;
}

</style>
