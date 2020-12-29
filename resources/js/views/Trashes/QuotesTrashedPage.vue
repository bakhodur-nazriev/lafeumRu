<template>
    <v-main class="pa-0">
        <index-page-layout
            no-actions
            ref="indexPage"
            search-field="body"
            index-url="/api/quotes-trashed"
            :categories="categories"
            :table-headers="this.headers"
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
                            elevation="2"
                            color="green"
                            @click="quoteToRestore = { ...item }"
                        >
                            <v-icon dark>mdi-arrow-left</v-icon>
                        </v-btn>
                    </template>
                    <span>Востановить</span>
                </v-tooltip>
                <v-tooltip top>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            fab
                            dark
                            small
                            v-on="on"
                            color="red"
                            elevation="2"
                            @click="quoteToForceDelete = { ...item }"
                        >
                            <v-icon dark>mdi-delete</v-icon>
                        </v-btn>
                    </template>
                    <span>Удалить безвазвратно</span>
                </v-tooltip>
            </template>
        </index-page-layout>
        <v-dialog v-model="showRestoreDialog" width="480">
            <v-card v-if="showRestoreDialog" class="pa-1">
                <v-card-title class="font-weight-regular headline text-center pa-2">
                    Вы действительно хотите востановить цитату ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn dark color="green" @click="quoteToRestore = null">Нет</v-btn>
                    <v-btn dark color="red" @click="restoreQuote()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="showForceDeleteDialog" width="500">
            <v-card v-if="showForceDeleteDialog" class="pa-2">
                <v-card-title class="font-weight-regular headline text-center pa-2">
                    Вы действительно хотите безвозвратно удалить эту цитату ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn dark color="green" @click="quoteToForceDelete = null">Нет</v-btn>
                    <v-btn dark color="red" @click="forceDeleteQuote()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-main>
</template>

<script>
import IndexPageLayout from "../../components/IndexPageLayout";

export default {
    components: {IndexPageLayout},
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
                },
                {
                    text: "Действия",
                    value: "action",
                    align: "center",
                    sortable: false,
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
        restoreQuote() {
            axios
                .put("/api/quote-trashed/" + this.quoteToRestore.id)
                .then(res => {
                    this.quoteToRestore = false;
                    this.$refs.indexPage.loadItems();
                })
                .catch(err => console.log(err))
        },
        forceDeleteQuote() {
            axios
                .delete("/api/quote-trashed/" + this.quoteToForceDelete.id)
                .then(res => {
                    this.quoteToForceDelete = false;
                    this.$refs.indexPage.loadItems();
                })
                .catch(err => console.log(err))
        },
    },
    computed: {
        showRestoreDialog: {
            get() {
                return this.quoteToRestore;
            },
            set(v) {
                if (!v) {
                    this.quoteToRestore = null;
                }
            }
        },
        showForceDeleteDialog: {
            get() {
                return this.quoteToForceDelete;
            },
            set(v) {
                if (!v) {
                    this.quoteToForceDelete = null;
                }
            }
        }
    },
}
</script>
