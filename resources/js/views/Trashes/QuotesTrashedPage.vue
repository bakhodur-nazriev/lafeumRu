<template>
    <v-main class="pa-0">
        <index-page-layout
            ref="indexPage"
            index-url="/api/quotes-trashes"
            :categories="categories"
            :table-headers="this.headers"
            search-field="body"
            @show-item="showQuote"
            @force-delete="quoteToDelete = $event"
            noActions
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
            <template v-if="!noActions" v-slot:item.action="{ item }">
                <v-btn
                    fab
                    dark
                    small
                    elevation="2"
                    color="green"
                >
                    <v-icon dark>mdi-arrow-left</v-icon>
                </v-btn>
                <v-btn
                    fab
                    dark
                    small
                    elevation="2"
                    color="red"
                >
                    <v-icon dark>mdi-delete</v-icon>
                </v-btn>
            </template>
        </index-page-layout>

        <quotes-restore-dialog/>
        <quote-force-delete-dialog
            v-model="quoteToForceDelete"
            @force-deleted="quoteForceDeleted"
        />
    </v-main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";
import QuotesRestoreDialog from "./QuotesRestoreDialog";
import QuoteForceDeleteDialog from "./QuotesForceDeleteDialog";

export default {
    components: {QuotesRestoreDialog, QuoteForceDeleteDialog, IndexPageLayout},
    data() {
        return {
            authors: [],
            categories: [],
            noActions: false,
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
                    width: 160
                },
                {
                    text: "Действия",
                    value: "action",
                    sortable: false,
                    align: "center",
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
        showQuote(quote) {
            window.open('/' + quote.post.id, '_blank');
        },
        quoteForceDeleted() {
            this.quoteToForceDelete = null;
            this.$refs.indexPage.loadItems();
        }
    }
}
</script>
