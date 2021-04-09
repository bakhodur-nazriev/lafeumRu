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

        <v-col cols="12" class="d-flex align-items-center pl-0 mb-8">
            <div class="form-search rounded-lg w-100">
                <v-text-field
                    solo
                    clearable
                    height="52"
                    hide-details
                    v-model="vocabularySearch"
                    placeholder="Область знаний"
                    background-color="transparent"
                    class="rounded-lg rounded-tr-0 rounded-br-0"
                >
                </v-text-field>
                <v-btn
                    depressed
                    height="52"
                    color="primary"
                    class="text-capitalize rounded-0"
                >
                    Поиск
                </v-btn>
            </div>
        </v-col>
        <div class="mb-9">
            <h5 class="subtitle-1">
                Примеры информативных поисковых запросов: «нау», «логия», «ика», «изм»,
                «фило», «само», «чело», «соц», «пси», «эво» и т.п.
            </h5>
        </div>

        <h5 class="text-uppercase font-weight-regular">все слова</h5>

        <div class="row" justify="center">
            <v-col cols="6" v-for="(column, i) in columns" :key="i">
                <v-card rounded="lg" class="px-8 py-5" flat>
                    <v-card-text class="pa-1" v-for="(term ,i) in column" :key="i">
                        <h1 class="vocabulary-letter text-decoration-none pt-4 pb-2">{{ term.group }}</h1>
                        <div class="truncate-to-seven-line">
                            <div
                                class="pb-1"
                                v-for="(child ,i) in term.children"
                                :key="i"
                            >
                                <a
                                    class="vocabulary-words text-decoration-none"
                                    :href="child.post.id"
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
        </div>

        <v-col cols class="text-center my-5">
<!--            <v-btn large class="grey lighten-1" icon>-->
<!--                <v-icon color="white">mdi-arrow-down</v-icon>-->
<!--            </v-btn>-->
        </v-col>
    </v-col>
</template>

<script>
export default {
    props: ["terms"],
    data() {
        return {
            allTerms: this.terms,
            vocabularySearch: "",
            maxVocabularyHeight: 100,
            page: 0,
            cols: 2
        };
    },
    computed: {
        orderVocabulary() {
            let allData = this.allTerms.reduce((r, e) => {
                let group = e.name[0];
                if (!r[group]) r[group] = {group, children: [e]}
                else r[group].children.push(e);
                return r;
            }, {})
            return Object.values(allData);
        },
        columns() {
            let columns = []
            let mid = Math.ceil(this.orderVocabulary.length / this.cols)
            for (let col = 0; col < this.cols; col++) {
                columns.push(this.orderVocabulary.slice(col * mid, col * mid + mid))
            }
            return columns
        }
    },
};
</script>

<style scoped>
.form-search {
    display: flex;
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
