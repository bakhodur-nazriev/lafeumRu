<template>
    <v-main class="pa-0">
        <index-page-layout
            no-actions
            ref="indexPage"
            index-url="/api/quotes-trashes"
            :categories="categories"
            :table-headers="this.headers"
            search-field="body"
            @show-item="showQuote"
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
            <template v-slot:item.action="{ item }">
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            fab
                            dark
                            small
                            v-on="on"
                            color="green"
                            elevetion="2"
                        >
                            <v-icon>mdi-arrow-left</v-icon>
                        </v-btn>
                    </template>
                    <span>Восстановить</span>
                </v-tooltip>
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            fab
                            dark
                            small
                            v-on="on"
                            color="red"
                            elevetion="2"
                        >
                            <v-icon>mdi-delete</v-icon>
                        </v-btn>
                    </template>
                    <span>Удалить безвозвратно</span>
                </v-tooltip>
            </template>

        </index-page-layout>

        <quote-force-delete-dialog
            v-model="quoteToForceDelete"
            @force-deleted="quoteForceDeleted"
        />
    </v-main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";
import QuoteForceDeleteDialog from "./QuotesForceDeleteDialog";

export default {
    components: {QuoteForceDeleteDialog, IndexPageLayout},
    data() {
        return {
            authors: [],
            categories: [],
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
                },
                {
                    text: "Действия",
                    value: "action",
                    width: "140px"
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
