<template>
    <v-content class="pa-0">
        <v-container fluid>
            <v-row justify="center">
                <v-col cols="6">
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
                                <v-icon dark>
                                    mdi-delete
                                </v-icon>
                            </v-btn>
                        </template>
                        <!-- <template v-slot:item.index="item"> -->
                        <!--    {{ getIndex() }} -->
                        <!-- </template> -->
                    </v-data-table>
                    <div class="text-center pt-2">
                        <v-pagination v-model="page" :length="pageCount"></v-pagination>
                    </div>
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
                    @click="dialogAdd = !dialogAdd"
                >
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
            <span>Добавить цитату</span>
        </v-tooltip>
        <!-- Add Item Dialog -->
        <v-dialog v-model="dialogAdd" width="600px">
            <v-card>
                <v-card-title class="primary white--text">
                    Создать Цитату
                </v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-select
                                outlined
                                :items="authors"
                                item-value="id"
                                item-text="name"
                                label="Автор"
                                dense
                                v-model="quoteAuthor"
                            >
                            </v-select>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                outlined
                                v-model="quoteBody"
                                name="body"
                                label="Добаить цитату здесь"
                            >
                            </v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="addQuote()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="() => (dialogAdd = false)"
                    >Отмена
                    </v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Delete Item Dialog -->
        <v-dialog v-model="dialogDelete" width="500">
            <v-card class="pa-2">
                <v-card-title class="pt-1 regular headline text-center"
                >Вы действительно хотите удалить эту цитату ?
                </v-card-title>
                <v-card-actions class="justify-center">
                    <v-btn color="green darken-1" dark @click="quoteToDelete = null"
                    >Нет
                    </v-btn
                    >
                    <v-btn color="red darken-1" dark @click="deleteQuote()">Да</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Update Item Dialog -->
        <v-dialog v-model="dialogUpdate" width="600px">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить Цитату
                </v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-select
                                outlined
                                :items="authors"
                                item-value="id"
                                item-text="name"
                                label="Авторы"
                                :value="quoteToUpdate.author_id"
                                dense
                            >
                            </v-select>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                outlined
                                label="Изменить цитату здесь"
                                :value="quoteToUpdate.body"
                                name="body"
                            >
                            </v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="updateQuote()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="dialogUpdate = false"
                    >Отмена
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Show Quote Dialog -->
        <v-dialog v-model="dialogShow"></v-dialog>
    </v-content>
</template>

<script>
    // function* getIterator(index, maxIndex) {
    //     let i = index;
    //     while (i <= maxIndex + 1) {
    //         if (i > maxIndex) {
    //             i = index;
    //         }
    //         yield i++;
    //     }
    // }

    export default {
        data() {
            return {
                quoteBody: "",
                quoteAuthor: "",
                search: "",
                authors: [],
                quotes: [],
                quoteToDelete: {
                    author_id: null,
                    body: null
                },
                quoteToUpdate: {
                    author_id: null,
                    body: null
                },
                page: 1,
                pageCount: 2,
                pagination: {},
                dialogShow: false,
                dialogAdd: false,
                dialogDelete: false,
                dialogUpdate: false,
                itemsPerPage: 15,
                editedIndex: -1,
                indexIterator: null,
                headers: [
                    {
                        text: "Цитата",
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
            this.loadQuotes();
            axios
                .get("/api/authors")
                .then(res => {
                    this.authors = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        methods: {
            loadQuotes() {
                axios
                    .get("/api/quotes")
                    .then(res => {
                        this.quotes = res.data;
                        // this.indexIterator = getIterator(1, res.data.length);
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            addQuote() {
                axios
                    .post("/api/quotes/", {
                        body: this.quoteBody,
                        author_id: this.quoteAuthor
                    })
                    .then(res => {
                        console.log(res);
                        this.loadQuotes();
                        this.dialogAdd = false;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            updateQuote() {
                axios
                    .put("/api/quotes/" + this.quoteToUpdate.id, {
                        body: this.quotes.body,
                        author_id: this.authors.name
                    })
                    .then(res => {
                        console.log(res);
                        this.loadQuotes();
                        this.dialogUpdate = false;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            deleteQuote() {
                axios
                    .delete("/api/quotes/" + this.quoteToDelete.id)
                    .then(res => {
                        this.loadQuotes();
                        this.dialogDelete = false;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            getIndex() {
                return this.indexIterator.next().value;
            }
        },
        watch: {
            quoteToUpdate(value) {
                if (value) {
                    this.dialogUpdate = true;
                } else {
                    this.dialogUpdate = false;
                }
            },

            quoteToDelete(value) {
                if (value) {
                    this.dialogDelete = true;
                } else {
                    this.dialogDelete = false;
                }
            }
        },
        computed: {
            filteredQuotes() {
                return this.quotes.filter(quote => {
                    return quote.body.toLowerCase().includes(this.search.toLowerCase());
                });
            }
        }
    };
</script>
