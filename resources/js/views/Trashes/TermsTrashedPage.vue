<template>
    <v-main class="pa-0">
        <index-page-layout
            ref="indexPage"
            search-field="body"
            index-url="/api/terms-trashed"
            :categories="categories"
            :table-headers="this.headers"
            @restore-item="termToRestore = $event"
            @force-delete-item="termToForceDelete = $event"
        >
            <template v-slot:item.body="{ item }">
                <div
                    v-html="item.body"
                    class="my-3 three-line-truncate"
                />
            </template>
            <template v-slot:item.knowledge="{ item }">
                <div
                    v-for="(know, i) in item.knowledge"
                    :key="i"
                >
                    {{ know.name }},
                </div>
            </template>
            <template v-slot:item.categories="{ item }">
                <div
                    v-for="(category, i) in item.categories"
                    :key="i"
                >
                    {{ category.name }},
                </div>
            </template>
        </index-page-layout>

        <terms-restore-dialog
            v-model="termToRestore"
            @restored="termRestored"
        />

        <terms-force-delete-dialog
            v-model="termToForceDelete"
            @force-deleted="termForceDeleted"
        />
    </v-main>
</template>

<script>
import TermsRestoreDialog from "./TermsRestoreDialog";
import IndexPageLayout from "../../components/IndexPageLayout";
import TermsForceDeleteDialog from "./TermsForceDeleteDialog";

export default {
    components: {
        IndexPageLayout,
        TermsRestoreDialog,
        TermsForceDeleteDialog
    },
    data() {
        return {
            termTypes: [],
            categories: [],
            knowledgeAreas: [],
            termToRestore: null,
            termToForceDelete: null,
            headers: [
                {
                    text: "Словарь",
                    value: "name"
                },
                {
                    text: "Термины",
                    value: "body",
                    class: "ma-3"
                },
                {
                    text: "Тип",
                    value: "term_type.name",
                    align: "center"
                },
                {
                    text: "Область знаний",
                    value: "knowledge",
                    align: "center"
                },
                {
                    text: "Рубрики",
                    value: "categories",
                    align: "center"
                },
                {
                    text: "Опубликовано",
                    value: "publish_at",
                    width: 160
                }
            ]
        };
    },
    mounted() {
        this.loadKnowledgeAreas();
        this.loadTermCategories();
        this.loadTermTypes();
    },
    methods: {
        loadTermTypes() {
            axios
                .get("/api/term-types")
                .then(res => (this.termTypes = res.data))
                .catch(e => console.log(e));
        },
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
        termRestored() {
            this.termToRestore = null;
            this.$refs.indexPage.loadItems();
        },
        termForceDeleted() {
            this.termToForceDelete = null;
            this.$refs.indexPage.loadItems();
        },
        showTerm(term) {
            window.open('/' + term.post.id, '_black');
        }
    }
}
</script>
