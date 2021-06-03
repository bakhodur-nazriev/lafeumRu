<template>
    <v-col xl="5" lg="6">
        <v-col cols="12" class="d-flex justify-center" v-if="loading">
            <v-progress-circular
                width="5"
                size="48"
                indeterminate
                color="primary"
            ></v-progress-circular>
        </v-col>
        <v-col cols="12" v-else class="pa-0">
            <h5 class="text-uppercase font-weight-regular py-2 mb-0">
                {{ currentKnowledge.name }}
            </h5>
            <p v-if="currentKnowledge.description" class="mb-4">
                {{ currentKnowledge.description }}
            </p>
        </v-col>
        <v-col cols="12" class="pa-0">
            <term-item
                v-for="(knowledge, i) in knowledgeArea"
                :key="i"
                :term="knowledge"
            ></term-item>
        </v-col>

        <v-col cols="12">
            <v-pagination
                v-model="pagination.current"
                :length="pagination.total"
                :total-visible="7"
                @input="onPageChange"
            ></v-pagination>
        </v-col>
    </v-col>
</template>

<script>
import TermItem from "../layouts/TermItem.vue";

export default {
    components: {TermItem},
    name: "KnowledgeArea",
    data() {
        return {
            windowUrl: window.location.pathname,
            loading: false,
            currentKnowledge: [],
            knowledgeArea: [],
            pagination: {
                current: 1,
                total: 0
            }
        };
    },
    methods: {
        getKnowledgeArea() {
            this.loading = true;
            axios
                .get(`/api${this.windowUrl}?page=` + this.pagination.current)
                .then((res) => {
                    this.loading = false;
                    this.currentKnowledge = res.data;
                    this.knowledgeArea = res.data.terms.data;
                    this.pagination.current = res.data.terms.current_page;
                    this.pagination.total = res.data.terms.last_page;
                })
                .catch((err) => {
                    this.laoding = false;
                    console.log(err);
                })
        },
        onPageChange() {
            this.getKnowledgeArea();
            window.scrollTo(0, 0);
        }
    },
    mounted() {
        this.getKnowledgeArea();
    }
};
</script>

<style scoped>
</style>
