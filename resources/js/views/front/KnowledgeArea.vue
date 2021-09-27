<template>
    <v-col xl="7" lg="8">
        <h5 class="text-uppercase font-weight-regular py-2">Области знаний</h5>
        <p>В этой рубрике термины и комментарии специалистов классифицированы
            <br/>более развернуто по группам и направлениям.
        </p>
        <v-col sm="12" md="6" class="d-flex align-center pl-0 mb-4">
            <v-col class="d-flex rounded-lg pa-0">
                <v-text-field
                    solo
                    flat
                    dense
                    clearable
                    height="40"
                    hide-details
                    v-model="search"
                    @click:clear="clearKnowledgeArea()"
                    background-color="transparent"
                    placeholder="Введите область знаний"
                    class="rounded-lg rounded-tr-0 rounded-br-0 search-field"
                >
                </v-text-field>
                <v-btn
                    text
                    depressed
                    height="44"
                    color="white"
                    class="text-capitalize rounded-0 primary rounded-br-lg rounded-tr-lg"
                >
                    Поиск
                </v-btn>
            </v-col>
        </v-col>
        <v-col cols="12" class="d-flex justify-center" v-if="loading">
            <v-progress-circular
                width="5"
                size="48"
                indeterminate
                color="primary"
            ></v-progress-circular>
        </v-col>
        <v-col v-else class="px-0">
            <v-card
                flat
                :key="i"
                class="knowledge-area-card mb-6 pa-3"
                v-for="(knowledgeArea, i) in filteredList"
            >
                <v-card-title class="d-flex py-3">
                    <div class="text-start w-100">
                        <h2 class="mb-0" style="font-size: 24px">
                            {{ knowledgeArea.name }}
                        </h2>
                    </div>
                    <v-col cols="12" class="list-col-4 px-0">
                        <v-card-text
                            class="pa-0 mb-1"
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
    </v-col>
</template>

<script>

export default {
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
        },
        clearKnowledgeArea() {
            this.filteredList = this.knowledgeAreas;
        }
    },
    mounted() {
        this.getKnowledgeArea();
    },
    computed: {
        filteredList: {
            get() {
                if (this.search) {
                    return this.knowledgeAreas.map(knowledge => {
                        const children = knowledge.children.filter(child => {
                            return child.name.toLowerCase().includes(this.search.toLowerCase()) || this.search.includes(child.name);
                        });
                        return {...knowledge, children}
                    });
                } else {
                    return this.knowledgeAreas;
                }
            },
            set(v) {
                this.knowledgeAreas = v;
            }
        },
    }
}
</script>

<style scoped>
.list-col-4 {
    column-count: 3;
}

@media (max-width: 600px) {
    .list-col-4 {
        column-count: 1;
    }
}

.search-field {
    border: 2px solid #9B9B9B;
    border-right: none;
}

.knowledge-area-card {
    border-radius: 16px !important;
    display: flex;
    justify-content: flex-start;
}

.knowledge-children-link {
    text-decoration: none;
    word-break: break-word;
    color: #04718c;
}

.knowledge-children-link:hover {
    color: #676767;
}
</style>
