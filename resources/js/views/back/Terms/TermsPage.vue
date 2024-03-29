<template>
    <v-main class="pa-0">
        <index-page-layout
            ref="indexPage"
            search-field="body"
            index-url="/api/terms"
            :categories="categories"
            :table-headers="this.headers"
            add-label="Добавить термин"
            @show-item="showTerm"
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

        <terms-create-dialog
            v-model="addTerm"
            :knowledge-areas="knowledgeAreas"
            :categories="categories"
            :term-types="termTypes"
            @created="termCreated"
        />

        <terms-edit-dialog
            v-model="termToUpdate"
            :knowledge-areas="knowledgeAreas"
            :term-types="termTypes"
            :categories="categories"
            @updated="termUpdated"
        />

        <terms-delete-dialog
            v-model="termToDelete"
            @deleted="termDeleted"
        />
    </v-main>
</template>
<script>
import IndexPageLayout from "../../../components/IndexPageLayout";
import TermsCreateDialog from "./TermsCreateDialog";
import TermsEditDialog from "./TermsEditDialog";
import TermsDeleteDialog from "./TermsDeleteDialog";

export default {
    components: {
        IndexPageLayout,
        TermsCreateDialog,
        TermsEditDialog,
        TermsDeleteDialog,
    },
    data() {
        return {
            addTerm: false,
            termTypes: [],
            categories: [],
            knowledgeAreas: [],
            termToUpdate: null,
            termToDelete: null,
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
        showTerm(term) {
            window.open('/' + term.post.id, '_black');
        }
    }
};
</script>
