<template>
    <v-content class="pa-0">
        <index-page-layout
            ref="indexPage"
            search-field="body"
            index-url="/api/quotes"
            :categories="categories"
            :table-headers="this.headers"
            add-label="Добавить цитату"
            @click:item="quoteClick"
            @add-item="addQuote = true"
            @update-item="quoteToUpdate = $event"
            @delete-item="quoteToDelete = $event"
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
                    {{category.name}},
                </div>
            </template>
        </index-page-layout>

        <quotes-create-dialog
            v-model="addQuote"
            :authors="authors"
            :categories="categories"
            @created="quoteCreated"
        />

        <quotes-edit-dialog
            v-model="quoteToUpdate"
            :authors="authors"
            :categories="categories"
            @updated="quoteUpdated"
        />

        <quotes-show-dialog
            :quote="quoteToShow"
            :categories="categories"
            @close="quoteToShow = null"
        />

        <quotes-delete-dialog
            v-model="quoteToDelete"
            @deleted="quoteDeleted"
        />
    </v-content>
</template>

<script>
    import IndexPageLayout from "../components/IndexPageLayout";
    import QuotesCreateDialog from "../views/QuotesCreateDialog";
    import QuotesEditDialog from "../views/QuotesEditDialog";
    import QuotesDeleteDialog from "../views/QuotesDeleteDialog";
    import QuotesShowDialog from "../views/QuotesShowDialog";

    export default {
        components: {
            IndexPageLayout,
            QuotesCreateDialog,
            QuotesEditDialog,
            QuotesDeleteDialog,
            QuotesShowDialog
        },
        data() {
            return {
                authors: [],
                categories: [],
                addQuote: false,
                quoteToShow: null,
                quoteToDelete: null,
                quoteToUpdate: null,
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
                ]
            };
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
            quoteCreated(newQuote) {
                this.addQuote = false;
                this.$refs.indexPage.loadItems();
            },
            quoteUpdated(updated) {
                this.quoteToUpdate = null;
                this.$refs.indexPage.loadItems();
            },
            quoteDeleted() {
                this.quoteToDelete = null;
                this.$refs.indexPage.loadItems();
            },
            quoteClick(quote) {
                this.quoteToShow = quote;
            }
        }
    };
</script>
