<template>
    <v-col xl="7" lg="9">
        <h5 class="text-uppercase font-weight-regular py-4">Области знаний</h5>
        <p class="grey--text">В этой рубрике термины и комментарии специалистов классифицированы<br/> более развернуто
            по
            группам и направлениям.</p>
        <v-col cols="7" class="d-flex align-items-center pl-0 mb-11">
            <div class="form-search rounded-lg w-100">
                <v-text-field
                    solo
                    clearable
                    height="52"
                    hide-details
                    v-model="search"
                    background-color="transparent"
                    placeholder="Область знаний"
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
        <v-col cols="12" class="d-flex justify-center" v-if="loading">
            <h5 class="text-uppercase font-weight-regular py-4">загурзка...</h5>
        </v-col>

        <div v-else>
            <v-card
                flat
                :key="i"
                class="knowledge-area-card mb-9 pa-7"
                v-for="(knowledgeArea, i) in filteredList"
            >
                <v-card-title class="d-flex flex-column">
                    <div class="text-start w-100 mb-4">
                        <h2 class="display-1 font-weight-medium">
                            {{ knowledgeArea.name }}
                        </h2>
                    </div>
                    <v-col cols="12" class="list-col-4 px-0">
                        <v-card-text
                            :key="i"
                            class="pa-0 py-1"
                            v-for="(knowledge, i) in knowledgeArea.children"
                        >
                            <a :href="`/knowledge/` + knowledge.slug">{{ knowledge.name }}</a>
                        </v-card-text>
                    </v-col>
                </v-card-title>
            </v-card>
        </div>
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
                    console.log(res.data);
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
            return this.knowledgeAreas.filter(knowledge => {
                return knowledge.name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
}
</script>

<style scope>
.list-col-4 {
    column-count: 3;
}

.form-search {
    display: flex;
    border: 2px solid #1a718c;
}

.knowledge-area-card {
    border-radius: 16px !important;
}
</style>
