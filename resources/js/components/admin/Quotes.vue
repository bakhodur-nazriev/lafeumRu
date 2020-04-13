<template>
    <v-content class="pa-0">
        <v-container fluid>
            <v-row justify="center">
                <v-col md="6">
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
                                color="primary"
                                elevation="2"
                                outlined
                                @click="quoteToShow = item"
                            >
                                <v-icon dark>mdi-file-eye-outline</v-icon>
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
                            <div v-html="item.body" class="short-paragraph"></div>
                        </template>
                    </v-data-table>
                    <v-col class="text-center mt-2">
                        <v-pagination :total-visible="7" v-model="page" :length="pageCount"></v-pagination>
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
                    @click="dialogAdd = !dialogAdd"
                >
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </template>
            <span>Добавить цитату</span>
        </v-tooltip>
        <!-- Add Item Dialog -->
        <v-dialog v-model="dialogAdd" width="700">
            <v-card>
                <v-card-title class="primary white--text">
                    Создать Цитату
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-select
                                hide-details
                                outlined
                                :items="quotes.author_id"
                                item-value="id"
                                item-text="name"
                                label="Автор"
                                v-model="quoteAuthor"
                            >
                            </v-select>
                        </v-col>
                        <v-col cols="12">
                            <tiptap-vuetify
                                outlined
                                :extensions="extensions"
                                v-model="quoteBody"
                                label="Добаить цитату здесь"
                            >
                            </tiptap-vuetify>
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
        <v-dialog v-if="quoteToDelete" v-model="quoteToDelete" width="500">
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
        <v-dialog v-if="quoteToUpdate" v-model="quoteToUpdate" width="700">
            <v-card>
                <v-card-title class="primary white--text">
                    Изменить Цитату
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-select
                                hide-details
                                outlined
                                item-value="id"
                                item-text="name"
                                label="Авторы"
                                :items="quotes.author_id"
                                v-model="quoteToUpdate.author_id"
                            >
                            </v-select>
                        </v-col>
                        <v-col cols="12">
                            <tiptap-vuetify
                                label="Изменить цитату здесь"
                                outlined
                                :extensions="extensions"
                                v-model="quoteToUpdate.body"
                            >
                                <!--:card-props="{ flat: true, color: '#26c6da' }"-->
                            </tiptap-vuetify>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="green" @click="updateQuote()">Сохранить</v-btn>
                    <v-btn dark color="error" @click="quoteToUpdate = false"
                    >Отмена
                    </v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Show Quote Dialog -->
        <v-dialog v-if="quoteToShow" v-model="quoteToShow" width="700">
            <v-card>
                <v-card-title class="primary white--text">
                    Цитата
                </v-card-title>
                <v-container>
                    <v-row justify="center">
                        <v-col cols="12">
                            <v-select
                                outlined
                                :items="quotes"
                                item-value="id"
                                item-text="name"
                                label="Авторы"
                                :value="quotes.author_id"
                            >
                            </v-select>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea
                                outlined
                                label="Изменить цитату здесь"
                                :value="quotes.body"
                                name="body"
                            >
                            </v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
                <v-card-actions>
                    <v-spacer/>
                    <v-btn dark color="error" @click="quoteToShow = false">Закрыть</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-content>
</template>

<script>
    import {
        // component
        TiptapVuetify,
        // extensions
        Heading,
        Bold,
        Italic,
        Strike,
        Underline,
        Paragraph,
        BulletList,
        OrderedList,
        ListItem,
        Link,
        Blockquote,
        HardBreak,
        HorizontalRule,
        History,
        Image
    } from "tiptap-vuetify";

    export default {
        components: {TiptapVuetify},
        data() {
            return {
                extensions: [
                    History,
                    Blockquote,
                    Link,
                    Underline,
                    Strike,
                    Italic,
                    ListItem,
                    BulletList,
                    OrderedList,
                    Image,
                    [
                        Heading,
                        {
                            options: {
                                levels: [1, 2, 3]
                            }
                        }
                    ],
                    Bold,
                    HorizontalRule,
                    Paragraph,
                    HardBreak
                ],
                quoteBody: "",
                quoteAuthor: "",
                search: "",
                quoteToDelete: null,
                quoteToUpdate: null,
                quoteToShow: null,
                page: 1,
                pageCount: 2,
                dialogShow: false,
                dialogAdd: false,
                dialogDelete: false,
                dialogUpdate: false,
                itemsPerPage: 15,
                editedIndex: -1,
                indexIterator: null,
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
                ],
                quotes: []
            };
        },
        mounted() {
            this.loadQuotes();
        },
        methods: {
            loadQuotes() {
                axios
                    .get("/api/quotes")
                    .then(res => {
                        this.quotes = res.data;
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
                        this.dialogAdd = false;
                        this.loadQuotes();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            updateQuote() {
                axios
                    .put("/api/quotes/" + this.quoteToUpdate.id, {
                        body: this.quoteToUpdate.body,
                        author_id: this.quoteToUpdate.author_id
                    })
                    .then(res => {
                        this.quoteToUpdate = false;
                        this.loadQuotes();
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
                        this.quoteToDelete = false;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        computed: {
            filteredQuotes() {
                return this.quotes.filter(quote => {
                    return quote.body.toLowerCase().includes(this.search.toLowerCase());
                })
            }
        }
    }
</script>
