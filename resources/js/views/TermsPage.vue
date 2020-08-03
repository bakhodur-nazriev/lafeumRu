<template>
    <v-content class="pa-0">
        <index-page-layout
            index-url="/api/terms"
            :table-headers="this.headers"
            add-label="Добавить термин"
            searchField="name"
            ref="indexPage"
            @click:item="termClick"
            @add-item="addTerm = true"
            @update-item="termToUpdate = $event"
            @delete-item="termToDelete = $event"
        >
            <template v-slot:item.body="{ item }">
                <div
                    v-html="item.body"
                    class="my-3 three-line-truncate"
                />
            </template>
        </index-page-layout>

        <terms-create-dialog
            v-model="addTerm"
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

        <terms-show-dialog
            :term="termToShow"
            :categories="categories"
            @close="termToShow = null"
        />

        <terms-delete-dialog
            v-model="termToDelete"
            @deleted="termDeleted"
        />
    </v-content>
</template>
<script>
    import IndexPageLayout from "../components/IndexPageLayout";
    import TermsCreateDialog from "./TermsCreateDialog";
    import TermsEditDialog from "./TermsEditDialog";
    import TermsDeleteDialog from "./TermsDeleteDialog";
    import TermsShowDialog from "./TermsShowDialog";

    export default {
        components: {
            IndexPageLayout,
            TermsCreateDialog,
            TermsEditDialog,
            TermsDeleteDialog,
            TermsShowDialog
        },
        data() {
            return {
                addTerm: false,
                categories: [],
                knowledgeAreas: [],
                termToShow: null,
                termToUpdate: null,
                termToDelete: null,
                headers: [
                    {
                        text: "Названия",
                        value: "name"
                    },
                    {
                        text: "Термины",
                        value: "body",
                        class: "ma-3"
                    },
                    {
                        text: "Дата добавления",
                        value: "created_at",
                        align: "center"
                    },
                    {
                        text: "Дата изменения",
                        value: "updated_at",
                        align: "center"
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
                this.addTerm = false;
                this.$refs.indexPage.loadItems();
            },
            termUpdated(newTerm) {
                this.termToUpdate = null;
                this.$refs.indexPage.loadItems();
            },
            termDeleted(newTerm) {
                this.termToDelete = null;
                this.$refs.indexPage.loadItems();
            },
            termClick(term) {
                this.termToShow = term;
            }
        }
    };
</script>
