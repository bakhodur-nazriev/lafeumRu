<template>
    <v-content class="pa-0">
        <index-page-layout
            index-url="/api/terms"
            :table-headers="this.headers"
            add-label="Добавить термин"
            searchField="name"
            ref="indexPage"
            @add-item="dialogAdd = true"
            @update-item="termToUpdate = $event"
            @delete-item="termToDelete = $event"
        >
            <template v-slot:item.body="{ item }">
                <div
                    v-html="item.body"
                    class="short-paragraph my-3 three-line-truncate"
                />
            </template>
        </index-page-layout>

        <terms-create-dialog
            v-model="dialogAdd"
            :knowledge-areas="knowledgeAreas"
            :categories="categories"
            @created="termCreated"
        />

        <terms-edit-dialog
            v-model="termToUpdate"
            :knowledge-areas="knowledgeAreas"
            :categories="categories"
            @updated="termUpdated"
        />

        <terms-delete-dialog v-model="termToDelete" @deleted="termDeleted" />
    </v-content>
</template>
<script>
import rules from "../validation-rules";

import IndexPageLayout from "../components/IndexPageLayout";
import TermsCreateDialog from "./TermsCreateDialog";
import TermsEditDialog from "./TermsEditDialog";
import TermsDeleteDialog from "./TermsDeleteDialog";

export default {
    components: {
        IndexPageLayout,
        "terms-create-dialog": TermsCreateDialog,
        "terms-edit-dialog": TermsEditDialog,
        "terms-delete-dialog": TermsDeleteDialog
    },
    data() {
        return {
            rules,
            dialogAdd: false,
            categories: [],
            knowledgeAreas: [],
            termToDelete: null,
            termToUpdate: null,
            headers: [
                {
                    text: "Название",
                    value: "name",
                    sortable: false
                },
                {
                    text: "Термины",
                    value: "body",
                    sortable: false,
                    class: "ma-3"
                }
            ]
        };
    },
    mounted() {
        this.loadKnowledgeAreas();
        this.loadTermCategories();
    },
    methods: {
        loadKnowledgeAreas() {
            axios
                .get("/api/knowledge-areas")
                .then(res => (this.knowledgeAreas = res.data))
                .catch(e => console.log(e));
        },
        loadTermCategories() {
            axios
                .get("/api/categories?type=" + TERM_TYPE)
                .then(res => (this.categories = res.data))
                .catch(e => console.log(e));
        },
        termCreated(newTerm) {
            this.dialogAdd = false;
            this.$refs.indexPage.loadItems();
        },
        termUpdated(newTerm) {
            this.termToUpdate = null;
            this.$refs.indexPage.loadItems();
        },
        termDeleted(newTerm) {
            this.termToDelete = null;
            this.$refs.indexPage.loadItems();
        }
    }
};
</script>
