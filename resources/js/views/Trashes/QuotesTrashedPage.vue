<template>
    <v-main class="pa-0">
        <index-page-layout
            ref="indexPage"
            search-field="body"
            index-url="/api/quotes-trashed"
            :categories="categories"
            :table-headers="this.headers"
            @restore-item="quoteToRestore = $event"
            @force-delete-item="quoteToForceDelete = $event"
        >
            <template v-slot:item.body="{ item }">
                <div
                    v-html="item.body"
                    class="my-3 three-line-truncate"
                />
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

        <quotes-restore-dialog
            v-model="quoteToRestore"
            @restored="quoteRestored"
        />

        <quotes-force-delete-dialog
            v-model="quoteToForceDelete"
            @force-deleted="quoteForceDeleted"
        />
    </v-main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";
import QuotesForceDeleteDialog from "./QuotesForceDeleteDialog";
import QuotesRestoreDialog from "./QuotesRestoreDialog";

export default {
    components: {
        IndexPageLayout,
        QuotesRestoreDialog,
        QuotesForceDeleteDialog
    },
    data() {
        return {
            authors: [],
            categories: [],
            quoteToRestore: null,
            quoteToForceDelete: null,
            headers: [
                {
                    text: "Цитаты",
                    value: "body",
                    align: "left",
                },
                {
                    text: "Автор",
                    value: "author.name",
                    align: "center",
                },
                {
                    text: "Рубрики",
                    value: "categories",
                    align: "center"
                },
                {
                    text: "Опубликовано",
                    value: "publish_at",
                    width: "160px"
                }
            ]
        }
    },
    mounted() {
        this.loadAuthors();
        this.loadQuoteCategories();
    },
    methods: {
        loadAuthors() {
            axios
                .get("/api/authors/?no_pagination")
                .then(res => (this.authors = res.data))
                .catch(e => console.log(e));
        },
        loadQuoteCategories() {
            axios
                .get("/api/categories?type=" + QUOTE_TYPE)
                .then(res => (this.categories = res.data))
                .catch(e => console.log(e));
        },
        quoteRestored() {
            this.quoteToRestore = null;
            this.$refs.indexPage.loadItems();
        },
        quoteForceDeleted() {
            this.quoteToForceDelete = null;
            this.$refs.indexPage.loadItems();
        }
    }
}
</script>
