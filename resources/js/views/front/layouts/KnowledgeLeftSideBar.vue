<template>
    <v-col xl="2"
           lg="3"
           md="3"
           class="left-side-knowledge-block"
    >
        <v-col class="hidden-sm-and-up">
            <v-expansion-panels flat>
                <v-expansion-panel>
                    <v-expansion-panel-header>
                        Область знаний
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <div>
                            <v-text-field
                                dense
                                outlined
                                clearable
                                class="mb-1"
                                hide-details
                                label="Введите область знаний"
                                v-model="search"
                                @click:clear="clearKnowledge()"
                            >
                            </v-text-field>

                            <!-- Knowledge Areas -->
                            <v-col cols="12" class="d-flex justify-center" v-if="loading">
                                <h5 class="text-uppercase font-weight-regular py-4">загурзка...</h5>
                            </v-col>
                            <v-col v-else class="pa-0">
                                <v-list-item
                                    v-for="(knowledgeArea, i) in filteredList"
                                    :key="i"
                                    class="px-1"
                                >
                                    <v-list-item-title class="knowledge-list-item-title mt-3">
                                        <span class="title px-0">
                                            {{ knowledgeArea.name }}
                                        </span>
                                        <v-divider class="my-2"></v-divider>
                                        <v-list-item-content
                                            v-for="(child ,i) in knowledgeArea.children"
                                            :key="i"
                                            class="py-1"
                                        >
                                            <v-list-item-subtitle class="knowledge-list-item-subtitle">
                                                <a
                                                    :href="`/knowledge/` + child.slug"
                                                    class="text-decoration-none">
                                                    {{ child.name }}
                                                </a>
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-list-item-title>
                                </v-list-item>
                            </v-col>
                        </div>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-col>

        <v-col class="hidden-xs-only pa-0">
            <h5 class="text-uppercase font-weight-normal py-4">Область знаний</h5>

            <v-sheet rounded="lg" width="100%">
                <div class="d-flex align-center pa-3">
                    <h5 class="ml-2 mb-0">Область знаний</h5>
                </div>
                <v-divider class="ma-0"></v-divider>
                <v-col class="pa-5">
                    <v-text-field
                        dense
                        outlined
                        clearable
                        class="mb-0"
                        hide-details
                        v-model="search"
                        label="Введите область знаний"
                        @click:clear="clearKnowledge()"
                    >
                    </v-text-field>

                    <!-- Knowledge Areas -->
                    <v-col cols="12" class="d-flex justify-center" v-if="loading">
                        <h5 class="text-uppercase font-weight-regular py-4">загурзка...</h5>
                    </v-col>
                    <v-col v-else class="pa-0">
                        <v-list-item
                            v-for="(knowledgeArea, i) in filteredList"
                            :key="i"
                            class="px-1"
                        >
                            <v-list-item-title class="knowledge-list-item-title mt-2">
                            <span class="title px-0">
                                {{ knowledgeArea.name }}
                            </span>
                                <v-list-item-content
                                    v-for="(child ,i) in knowledgeArea.children"
                                    :key="i"
                                    class="py-1"
                                >
                                    <v-list-item-subtitle class="knowledge-list-item-subtitle">
                                        <a
                                            :href="`/knowledge/` + child.slug"
                                            class="text-decoration-none">
                                            {{ child.name }}
                                        </a>
                                    </v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item-title>
                        </v-list-item>
                    </v-col>
                </v-col>
            </v-sheet>
        </v-col>
    </v-col>
</template>

<script>
export default {
    name: "KnowledgeArea",
    data() {
        return {
            search: "",
            loading: false,
            knowledgeAreas: []
        }
    },
    methods: {
        getKnowledgeArea() {
            this.laoding = true;
            axios
                .get("/api/front/knowledge")
                .then(res => {
                    this.loading = false;
                    this.knowledgeAreas = res.data;
                })
                .catch(err => {
                    this.loading = false;
                    console.log(err);
                })
        },
        clearKnowledge() {
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
                    })
                } else {
                    return this.knowledgeAreas;
                }
            },
            set(v) {
                this.knowledgeAreas = v;
            }
        }
    }
}
</script>

<style scoped>
.knowledge-list-item-title,
.knowledge-list-item-subtitle {
    white-space: initial;
}

.knowledge-list-item-subtitle > a {
    color: #000;
    line-height: 1.4;
}

.knowledge-list-item-subtitle > a:hover {
    color: #04718c;
}

</style>
