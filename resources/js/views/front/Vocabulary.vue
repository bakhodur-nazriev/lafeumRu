<template>
    <v-col xl="5" lg="6" class="px-5">
        <!--        <div v-if="category">-->
        <!--            <h3 class="secondary">{{ category.name }}</h3>-->
        <!--            <p>{{ category.description }}</p>-->
        <!--        </div>-->
        <div>
            <h5 class="text-uppercase font-weight-regular py-4">Словарь «ЛАФЕЮМ»</h5>
            <p class="grey--text">
                На сегодня содержит более одной тысячи основных терминов, соответствующих
                тематике сайта. Для удобства термины дополнительно разбиты на темы.
                Большинство терминов взяты из Википедии с указанием ссылки на источник. В
                большинстве понятий имеются другие взаимосвязанные термины и ссылки. По
                мере обновления на основном источнике здесь они будут равным образом
                обновляться.
            </p>
        </div>

        <v-col cols="12" class="d-flex align-items-center pl-0">
            <div class="form-search rounded-lg w-100">
                <v-text-field
                    solo
                    flat
                    clearable
                    height="48"
                    hide-details
                    @click:clear="clearVocabulary()"
                    v-model="search"
                    background-color="transparent"
                    placeholder="Введите область знаний"
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
        <v-col cols="12" class="mb-3">
            <h5 class="subtitle-1">
                Примеры информативных поисковых запросов: «нау», «логия», «ика», «изм»,
                «фило», «само», «чело», «соц», «пси», «эво» и т.п.
            </h5>
        </v-col>

        <h5 class="text-uppercase font-weight-regular ml-1">все слова</h5>
        <v-col cols="12" class="d-flex justify-center" v-if="loading">
            <v-progress-circular
                width="5"
                size="48"
                indeterminate
                color="primary"
            ></v-progress-circular>
        </v-col>

        <v-row justify="center" v-else>
            <v-col cols="6" v-for="(vocabulary, i) in filteredVocabulary" :key="i">
                <v-card rounded="lg" class="px-8 py-5" flat>
                    <v-card-text
                        class="pa-1"
                        v-for="(term ,i) in vocabulary"
                        :key="i"
                    >
                        <list-of-vocabulary :item="term"></list-of-vocabulary>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <scroller></scroller>
    </v-col>
</template>

<script>
import Scroller from "../../components/Scroller";
import ListOfVocabulary from "../../components/ListOfChildren/ListOfVocabulary";

export default {
    components: {
        Scroller,
        ListOfVocabulary
    },
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
        },
        clearVocabulary() {
            this.filteredVocabulary = this.terms
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
        columns() {
            let columns = [];
            let mid = Math.ceil(this.orderVocabulary.length / this.cols);
            for (let col = 0; col < this.cols; col++) {
                columns.push(this.orderVocabulary.slice(col * mid, col * mid + mid));
            }
            return columns;
        },
        filteredVocabulary: {
            get() {
                if (this.search) {
                    return this.columns.map(terms => {
                        return terms.map(term => {
                            const children = term.children.filter(child => {
                                return child.name.toLowerCase().includes(this.search.toLowerCase()) || this.search.includes(child.name)
                            });
                            return {...term, children}
                        })
                    });
                } else {
                    return this.columns;
                }
            },
            set(v) {
                this.terms = v;
            }
        },
    },
};
</script>

<style scoped>

.form-search {
    display: flex;
}

.search-filed {
    border: 2px solid #9B9B9B;
    border-right: none;
}
</style>
