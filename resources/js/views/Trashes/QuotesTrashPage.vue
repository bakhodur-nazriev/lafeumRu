<template>
    <v-main class="pa-0">
        <index-page-layout
            ref="indexPage"
            index-url="/api/quotes-trashes"
            :categories="categories"
            :table-headers="this.headers"
            search-field="body"
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

        <quotes-reverse-dialog/>
        <quote-force-delete-dialog/>
    </v-main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";
import QuotesReverseDialog from "./QuotesRestoreDialog";
import QuoteForceDeleteDialog from "./QuotesForceDeleteDialog";

export default {
    components: {QuoteForceDeleteDialog, QuotesReverseDialog, IndexPageLayout},
    data() {
        return {
            authors: [],
            categories: [],
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
        }
    }
}
</script>
