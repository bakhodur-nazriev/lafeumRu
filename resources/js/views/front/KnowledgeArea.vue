<template>
    <v-col xl="7" lg="9">
        <h5 class="text-uppercase font-weight-regular py-4 ">Области знаний</h5>
        <p class="grey--text">В этой рубрике термины и комментарии специалистов классифицированы
            <br/>более развернуто по группам и направлениям.
        </p>
        <v-col cols="7" class="d-flex align-center pl-0 mb-11">
            <div class="form-search rounded-lg w-100">
                <div class="form-search-text-side">
                    <v-text-field
                        solo
                        flat
                        height="48"
                        hide-details
                        v-model="search"
                        placeholder="Область знаний"
                        background-color="transparent"
                        class="rounded-lg rounded-tr-0 rounded-br-0 search-field"
                    >
                    </v-text-field>
                </div>
                <v-btn
                    text
                    depressed
                    height="52"
                    color="white"
                    class="text-capitalize rounded-0 primary rounded-br-lg rounded-tr-lg"
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
        <v-col v-else class="pl-0">
            <v-card
                flat
                :key="i"
                width="99%"
                class="knowledge-area-card mb-9 pa-7"
                v-for="(knowledgeArea, i) in filteredList"
            >
                <v-card-title class="d-flex">
                    <div class="text-start w-100">
                        <h2 class="display-1 font-weight-medium">
                            {{ knowledgeArea.name }}
                        </h2>
                    </div>
                    <v-col cols="12" class="list-col-4 px-0">
                        <v-card-text
                            class="pa-0 mb-2"
                            v-for="(knowledge, i) in knowledgeArea.children"
                            :key="i"
                        >
                            <a
                                :href="`/knowledge/` + knowledge.slug"
                                class="knowledge-children-link"
                            >{{ knowledge.name }}</a>
                        </v-card-text>
                    </v-col>
                </v-card-title>
            </v-card>
        </v-col>
        <scroller></scroller>
    </v-col>
</template>

<script>
import Scroller from "../../components/Scroller";

export default {
    components: {Scroller},
    name: "knowledgeArea",
    data() {
        return {
            search: "",
            knowledgeAreas: [],
            loading: false
        }
    },
    methods: {
        getKnowledgeArea() {
            this.loading = true;
            axios
                .get("/api/knowledge")
                .then(res => {
                    this.loading = false;
                    this.knowledgeAreas = res.data;
                })
                .catch(err => {
                    this.laoding = false;
                    console.log(err);
                })
        }
    },
    mounted() {
        this.getKnowledgeArea();
    },
    computed: {
        filteredList() {
            return this.knowledgeAreas.map(knowledge => {
                const children = knowledge.children.filter(child => {
                    return child.name.toLowerCase().includes(this.search.toLowerCase()) || this.search.includes(child.name);
                });
                return {...knowledge, children}
            })
        }
    }
}
</script>

<style scoped>
.list-col-4 {
    column-count: 3;
}

.form-search {
    display: flex;
}

.search-field {
    border: 2px solid #9B9B9B;
    border-right: none;
}

.form-search-text-side {
    width: 80%;
}

.form-search-button-side {
    width: 20%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    background-color: #1a718c;
    border-bottom-right-radius: 5px;
    border-top-right-radius: 5px;
    position: relative;
    bottom: 1px;
}

.knowledge-area-card {
    border-radius: 16px !important;
    display: flex;
    justify-content: start;
}

.knowledge-children-link {
    text-decoration: none;
    word-break: break-word;
}

.knowledge-children-link:hover {
    color: #676767;
}
</style>
