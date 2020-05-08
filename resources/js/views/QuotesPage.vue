<template>
    <v-content class="pa-0">
        <v-container fluid>
            <v-row justify="center">
                <v-col md="6" xl="4">
                    <v-text-field
                        solo
                        hide-details
                        class="mb-1"
                        label="Поиск"
                        append-icon="mdi-magnify"
                        v-model="search"
                    >
                    </v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-data-table
                        :headers="headers"
                        :items="filteredQuotes"
                        :items-per-page="itemsPerPage"
                        :page.sync="page"
                        @page-count="pageCount = $event"
                        hide-default-footer
                        class="elevation-2"
                        :loading="loadingQuotes"
                        loading-text="Загрузка..."
                    >
                        <template v-slot:item.action="{ item }">
                            <v-btn
                                fab
                                dark
                                small
                                color="primary"
                                elevation="2"
                                outlined
                                @click="quoteToUpdate = item"
                            >
                                <v-icon dark>mdi-pen</v-icon>
                            </v-btn>
                            <v-btn
                                fab
                                dark
                                small
                                color="error"
                                elevation="2"
                                outlined
                                @click="quoteToDelete = item"
                            >
                                <v-icon dark>mdi-delete</v-icon>
                            </v-btn>
                        </template>
                        <template v-slot:item.body="{ item }">
                            <div
                                v-html="item.body"
                                class="short-paragraph my-3 three-line-truncate"
                            />
                        </template>
                    </v-data-table>
                    <v-col class="text-center mt-2">
                        <v-pagination
                            :total-visible="7"
                            v-model="page"
                            :length="pageCount"
                        ></v-pagination>
                    </v-col>
                </v-col>
            </v-row>
        </v-container>
        <v-tooltip top>
            <template v-slot:activator="{ on }">
                <v-btn
                    bottom
                    color="primary"
                    v-on="on"
                    dark
                    fab
                    fixed
                    right
                    @click="addQuote = !addQuote"
                >
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
            <span>Добавить цитату</span>
        </v-tooltip>

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

    </v-content>
</template>

<script>
import QuotesCreateDialog from "../views/QuotesCreateDialog";
import QuotesEditDialog from "../views/QuotesEditDialog";
import QuotesDeleteDialog from "../views/QuotesDeleteDialog";

export default {
    components: {
        QuotesCreateDialog,
        QuotesEditDialog,
        QuotesDeleteDialog
    },
    data() {
        return {
            authors: [],
            categories: [],
            search: "",
            addQuote: false,
            quoteToDelete: null,
            quoteToUpdate: null,
            page: 1,
            pageCount: 2,
            itemsPerPage: 15,
            editedIndex: -1,
            indexIterator: null,
            quotes: [],
            loadingQuotes: false,
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
                    text: "Действия",
                    value: "action",
                    align: "center",
                    sortable: false,
                    width: "160px"
                }
            ]
        };
    },
    mounted() {
        this.loadAuthors();
        this.loadQuoteCategories();
        this.loadQuotes();
    },
    methods: {
        loadQuotes() {
            this.loadingQuotes = true;
            axios
                .get("/api/quotes")
                .then(res => {
                    this.loadingQuotes = false;
                    this.quotes = res.data;
                })
                .catch(err => {
                    this.loadingPhotos = false;
                    console.log(err);
                });
        },
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
        quoteCreated(newQuote){
            this.addQuote = false;
            this.loadQuotes();
        },
        quoteUpdated(updated){
            this.quoteToUpdate = null;
            this.loadQuotes();
        },
        quoteDeleted(){
            this.quoteToDelete = null;
            this.loadQuotes();
        },
    },
    computed: {
        filteredQuotes() {
            return this.quotes.filter(quote => {
                return quote.body
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        }
    }
};
</script>
