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


        <div v-if="isSearching">
            <search-vocabulary @clicked="processingFinished"/>
        </div>

        <!--        <div>
                    <all-vocabulary @clicked="processingFinished"/>
                    &lt;!&ndash;            <infinite-loading @disance="1" @infinite="getVocabulary">
                                    <div slot="no-results"></div>
                                    <div slot="no-more"></div>
                                </infinite-loading>&ndash;&gt;
                </div>-->

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
            isSearching: true,
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
        clearVocabulary() {
            this.filteredVocabulary = this.terms;
        },
        processingFinished(value) {
            this.isSearching = value;
            console.log(value);
        }
    },
    mounted() {
        this.getVocabulary();
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
