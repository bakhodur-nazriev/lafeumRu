<template>
    <v-main class="pa-0">
        <index-page-layout
            ref="indexPage"
            search-field="body"
            index-url="/api/quotes"
            :categories="categories"
            :table-headers="this.headers"
            add-label="Добавить цитату"
            @show-item="showQuote"
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
                    {{ category.name }},
                </div>
            </template>
            <template v-slot:item.authors_thoughts="{ item }">
                <div
                    v-html="item.authors_thoughts"
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

        <quotes-delete-dialog
            v-model="quoteToDelete"
            @deleted="quoteDeleted"
        />
    </v-main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";
import QuotesCreateDialog from "./QuotesCreateDialog";
import QuotesEditDialog from "./QuotesEditDialog";
import QuotesDeleteDialog from "./QuotesDeleteDialog";

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
                },
                {
                    text: "Автор",
                    value: "author.name",
                    align: "center",
                },
                {
                    text: "Примечание",
                    value: "authors_thoughts",
                    align: "center",
                    width: "160px"
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
        quoteCreated() {
            this.addQuote = false;
            this.$refs.indexPage.loadItems();
        },
        quoteUpdated() {
            this.quoteToUpdate = null;
            this.$refs.indexPage.loadItems();
        },
        quoteDeleted() {
            this.quoteToDelete = null;
            this.$refs.indexPage.loadItems();
        },
        showQuote(quote) {
            window.open('/' + quote.post.id, '_blank');
        }
    }
};
</script>
