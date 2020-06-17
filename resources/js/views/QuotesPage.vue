<template>
    <v-content class="pa-0">
        <index-page-layout
            index-url="/api/quotes"
            :table-headers="this.headers"
            add-label="Добавить цитату"
            search-field="body"
            ref="indexPage"
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

        <quotes-delete-dialog v-model="quoteToDelete" @deleted="quoteDeleted"/>
    </v-content>
</template>

<script>
    import IndexPageLayout from "../components/IndexPageLayout";
    import QuotesCreateDialog from "../views/QuotesCreateDialog";
    import QuotesEditDialog from "../views/QuotesEditDialog";
    import QuotesDeleteDialog from "../views/QuotesDeleteDialog";

    export default {
        components: {
            IndexPageLayout,
            QuotesCreateDialog,
            QuotesEditDialog,
            QuotesDeleteDialog
        },
        data() {
            return {
                authors: [],
                categories: [],
                addQuote: false,
                quoteToDelete: null,
                quoteToUpdate: null,
                headers: [
                    {
                        text: "Цитаты",
                        value: "body",
                        align: "left",
                        sortable: false
                    },
                    {
                        text: "Автор",
                        value: "author.name",
                        align: "center",
                        sortable: false
                    },
                    {
                        text: "Дата добавления",
                        value: "created_at",
                        align: "center",
                        sortable: false
                    },
                    {
                        text: "Дата изменения",
                        value: "updated_at",
                        align: "center",
                        sortable: false
                    }
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
                    .get("/api/authors")
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
            }
        }
    };
</script>
