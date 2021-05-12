<template>
    <v-col lg="3" xl="2">
        <h5 class="text-uppercase text-secondary font-weight-normal py-4">Область знаний</h5>

        <v-sheet rounded="lg" width="100%">
            <div class="d-flex align-center pa-5">
                <h5 class="ml-2 mb-0">Область знаний</h5>
            </div>
            <v-divider class="ma-0"></v-divider>
            <div class="pa-6">
                <v-text-field
                    label="Введите область знаний"
                    v-model="search"
                    hide-details
                    class="mb-1"
                    outlined
                    dense
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
            <!-- <v-col cols="12" class="d-flex justify-center mt-2">
                <v-btn
                    fab
                    small
                    rounded
                    elevation="0"
                    color="grey lighten-2"
                >
                    <v-icon color="white">mdi-arrow-down</v-icon>
                </v-btn>
            </v-col> -->
        </v-sheet>
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
                .get("/api/knowledge")
                .then(res => {
                    this.loading = false;
                    this.knowledgeAreas = res.data;
                })
                .catch(err => {
                    this.loading = false;
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
.knowledge-list-item-title {
    white-space: initial;
}

.knowledge-list-item-subtitle {
    white-space: initial;
}

.knowledge-list-item-subtitle > a {
    color: #04718c;
    line-height: 1.4;
}

.knowledge-list-item-subtitle > a:hover {
    color: #00000099;
}

</style>
